<?php

namespace App\Http\Controllers;

use App\Models\Diet;
use Anthropic\Client as AnthropicClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
            'diet_slug' => 'nullable|string',
            'servings' => 'nullable|integer|min:1|max:6',
        ]);

        $apiKey = config('services.anthropic.api_key');
        if (!$apiKey) {
            return response()->json(['error' => 'Chat service not configured'], 500);
        }

        // Get conversation history from session
        $history = Session::get('chat_history', []);

        // Get current diet context if available
        $dietContext = '';
        if ($request->diet_slug) {
            $diet = Diet::where('slug', $request->diet_slug)->first();
            if ($diet) {
                $dietContext = "The user is currently viewing a {$diet->name} meal plan for {$request->servings} people.";
            }
        }

        // Build system prompt
        $systemPrompt = $this->buildSystemPrompt($dietContext);

        // Add user message to history
        $history[] = [
            'role' => 'user',
            'content' => $request->message,
        ];

        try {
            $client = new AnthropicClient($apiKey);

            $response = $client->messages->create([
                'model' => 'claude-sonnet-4-20250514',
                'max_tokens' => 1024,
                'system' => $systemPrompt,
                'messages' => array_slice($history, -10), // Keep last 10 messages for context
            ]);

            $assistantMessage = $response->content[0]->text;

            // Add assistant response to history
            $history[] = [
                'role' => 'assistant',
                'content' => $assistantMessage,
            ];

            // Save history (keep last 20 messages)
            Session::put('chat_history', array_slice($history, -20));

            return response()->json([
                'message' => $assistantMessage,
            ]);

        } catch (\Exception $e) {
            \Log::error('Chat API error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to get response. Please try again.',
            ], 500);
        }
    }

    public function clearHistory()
    {
        Session::forget('chat_history');
        return response()->json(['success' => true]);
    }

    private function buildSystemPrompt(string $dietContext): string
    {
        $diets = Diet::all()->pluck('name')->implode(', ');

        return <<<PROMPT
You are a helpful meal planning assistant for LoseWeightSlowly.com. Your role is to help users customize their meal plans, suggest variations, and answer questions about healthy eating.

Available diet types: {$diets}

{$dietContext}

You can help users with:
1. **Customizing their diet** - Swap out ingredients they don't like, suggest alternatives for allergies
2. **Pantry inventory** - Help adjust shopping lists based on what they already have
3. **Cooking variations** - Suggest how to prepare meals with different cuisines (Indian, Japanese, Mexican, Italian, Thai, etc.)
4. **Nutrition questions** - Answer questions about the diets and ingredients
5. **Meal prep tips** - Help with batch cooking, storage, and time-saving strategies

Guidelines:
- Keep responses concise and actionable
- When suggesting cuisine variations, provide specific spices/sauces to use
- If users mention foods they have on hand, suggest how to incorporate them
- Be encouraging and supportive about their health journey
- Use markdown formatting for lists and emphasis when helpful
- Don't recommend specific calorie counts or medical nutrition advice

Example cuisine variations you might suggest:
- **Indian**: Add garam masala, turmeric, cumin, coriander. Use ghee instead of olive oil. Serve with basmati rice.
- **Japanese**: Use miso, soy sauce, mirin, rice vinegar. Add ginger and green onions. Serve with short-grain rice.
- **Mexican**: Add cumin, chili powder, lime, cilantro. Use black beans and corn. Top with fresh salsa.
- **Mediterranean**: Use oregano, lemon, olive oil, garlic. Add olives and feta.
- **Thai**: Add fish sauce, lime, basil, lemongrass. Use coconut milk. Serve with jasmine rice.
PROMPT;
    }
}
