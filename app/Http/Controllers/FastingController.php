<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class FastingController extends Controller
{
    public function index(): View
    {
        return view('fasting.index');
    }

    public function plan(string $slug): View
    {
        $plans = $this->getPlans();

        if (!isset($plans[$slug])) {
            abort(404);
        }

        return view('fasting.plan', ['plan' => $plans[$slug], 'slug' => $slug, 'allPlans' => $plans]);
    }

    public function timer(): View
    {
        return view('fasting.timer');
    }

    public function getPlans(): array
    {
        return [
            '16-8' => [
                'name' => '16:8 Method',
                'subtitle' => 'The most popular and sustainable approach',
                'fasting_hours' => 16,
                'eating_hours' => 8,
                'difficulty' => 'Beginner',
                'color' => 'emerald',
                'summary' => 'Fast for 16 hours, eat within an 8-hour window. Most people skip breakfast and eat from noon to 8 PM.',
                'description' => 'The 16:8 method is the most popular form of intermittent fasting. You restrict eating to an 8-hour window each day and fast for the remaining 16 hours (including sleep). Most people find it easiest to skip breakfast and eat between noon and 8 PM, but you can shift the window to fit your schedule.',
                'how_it_works' => [
                    'Choose an 8-hour eating window (e.g., 12 PM - 8 PM)',
                    'Eat your normal meals within that window',
                    'Fast for the remaining 16 hours',
                    'During fasting: water, black coffee, and plain tea are fine',
                    'Start with 12:12 if 16:8 feels too aggressive, then gradually extend',
                ],
                'sample_schedule' => [
                    '7:00 AM' => 'Wake up — water, black coffee',
                    '12:00 PM' => 'First meal (lunch)',
                    '3:00 PM' => 'Snack if needed',
                    '7:30 PM' => 'Last meal (dinner)',
                    '8:00 PM' => 'Eating window closes',
                    '10:00 PM' => 'Sleep',
                ],
                'benefits' => [
                    'Easy to maintain long-term',
                    'Aligns naturally with most social schedules',
                    'Helps reduce late-night snacking',
                    'May improve insulin sensitivity',
                    'Can be combined with any diet style',
                ],
                'tips' => [
                    'Stay hydrated during the fasting window',
                    'Keep busy during morning hours to avoid hunger',
                    'Don\'t overcompensate by overeating during your window',
                    'Be flexible — shifting your window by an hour occasionally is fine',
                ],
            ],
            '18-6' => [
                'name' => '18:6 Method',
                'subtitle' => 'A step up for experienced fasters',
                'fasting_hours' => 18,
                'eating_hours' => 6,
                'difficulty' => 'Intermediate',
                'color' => 'blue',
                'summary' => 'Fast for 18 hours, eat within a 6-hour window. Typically two meals per day.',
                'description' => 'The 18:6 method extends the fasting period to 18 hours with a 6-hour eating window. This typically means eating two meals per day. It provides stronger metabolic benefits than 16:8 while still being sustainable for most people who have adapted to intermittent fasting.',
                'how_it_works' => [
                    'Choose a 6-hour eating window (e.g., 12 PM - 6 PM)',
                    'Eat two satisfying meals within that window',
                    'Fast for the remaining 18 hours',
                    'During fasting: water, black coffee, and plain tea are fine',
                    'Master 16:8 before progressing to this schedule',
                ],
                'sample_schedule' => [
                    '7:00 AM' => 'Wake up — water, black coffee',
                    '12:00 PM' => 'First meal (substantial lunch)',
                    '5:30 PM' => 'Second meal (dinner)',
                    '6:00 PM' => 'Eating window closes',
                    '10:00 PM' => 'Sleep',
                ],
                'benefits' => [
                    'Deeper autophagy activation than 16:8',
                    'Naturally reduces calorie intake',
                    'Simplifies meal planning to 2 meals',
                    'Stronger insulin sensitivity improvements',
                    'Still sustainable for daily use',
                ],
                'tips' => [
                    'Make your two meals nutrient-dense and satisfying',
                    'Don\'t rush into 18:6 — build up from 16:8',
                    'Electrolytes can help if you feel lightheaded',
                    'Plan meals ahead so you maximize nutrition in the window',
                ],
            ],
            '20-4' => [
                'name' => '20:4 Method',
                'subtitle' => 'The Warrior Diet approach',
                'fasting_hours' => 20,
                'eating_hours' => 4,
                'difficulty' => 'Advanced',
                'color' => 'purple',
                'summary' => 'Fast for 20 hours, eat within a 4-hour window. One large meal plus a small snack.',
                'description' => 'The 20:4 method, popularized by Ori Hofmekler\'s "Warrior Diet," involves a 20-hour fasting period with a 4-hour eating window. During the fast, small amounts of raw fruits, vegetables, or light protein are sometimes permitted. The main meal is eaten in the evening.',
                'how_it_works' => [
                    'Choose a 4-hour eating window (e.g., 4 PM - 8 PM)',
                    'Eat one large meal and possibly a small snack',
                    'Fast for the remaining 20 hours',
                    'Some versions allow small raw snacks during the day',
                    'Only attempt after being comfortable with 18:6',
                ],
                'sample_schedule' => [
                    '7:00 AM' => 'Wake up — water, black coffee',
                    '12:00 PM' => 'Optional: small piece of fruit or handful of nuts',
                    '5:00 PM' => 'Main meal begins',
                    '7:00 PM' => 'Finish eating, small dessert if desired',
                    '8:00 PM' => 'Eating window closes',
                ],
                'benefits' => [
                    'Significant autophagy and cellular repair',
                    'Strong fat-burning state maintained most of the day',
                    'Simplifies life to essentially one meal',
                    'May improve growth hormone production',
                    'Aligns with historical human eating patterns',
                ],
                'tips' => [
                    'Your one meal needs to be very nutrient-dense',
                    'Don\'t try to eat 2,000 calories in one sitting — ease into portions',
                    'Listen to your body — this isn\'t for everyone',
                    'Consider supplementing with electrolytes and a multivitamin',
                ],
            ],
            'omad' => [
                'name' => 'OMAD',
                'subtitle' => 'One Meal A Day',
                'fasting_hours' => 23,
                'eating_hours' => 1,
                'difficulty' => 'Advanced',
                'color' => 'red',
                'summary' => 'Eat one complete meal per day within roughly a 1-hour window.',
                'description' => 'OMAD (One Meal A Day) takes intermittent fasting to its most extreme daily form. You eat a single, large, nutrient-dense meal and fast for the remaining 23 hours. This approach delivers maximum fasting benefits but requires careful attention to nutrition to avoid deficiencies.',
                'how_it_works' => [
                    'Choose one meal per day (lunch or dinner)',
                    'Eat to satisfaction within roughly 1 hour',
                    'Fast for the remaining 23 hours',
                    'Water, black coffee, and plain tea during fasting',
                    'Ensure the single meal covers all nutritional needs',
                ],
                'sample_schedule' => [
                    '7:00 AM' => 'Wake up — water, black coffee',
                    '12:00 PM' => 'Water, tea',
                    '6:00 PM' => 'One large, balanced meal',
                    '7:00 PM' => 'Done eating for the day',
                    '10:00 PM' => 'Sleep',
                ],
                'benefits' => [
                    'Maximum daily autophagy and fat burning',
                    'Extremely simple — no meal planning or prep',
                    'Lowest possible time spent eating',
                    'Dramatic insulin sensitivity improvements',
                    'Can break through weight loss plateaus',
                ],
                'tips' => [
                    'This is not a long-term approach for most people — use it periodically',
                    'Your meal MUST include adequate protein, fats, and micronutrients',
                    'Consider a multivitamin and electrolyte supplement',
                    'Avoid doing this more than 3-4 days per week initially',
                    'Stop immediately if you feel dizzy, weak, or unwell',
                ],
            ],
            '5-2' => [
                'name' => '5:2 Diet',
                'subtitle' => 'Eat normally 5 days, restrict 2',
                'fasting_hours' => 0,
                'eating_hours' => 0,
                'difficulty' => 'Beginner',
                'color' => 'amber',
                'summary' => 'Eat normally for 5 days per week. On 2 non-consecutive days, limit intake to 500-600 calories.',
                'description' => 'The 5:2 diet, popularized by Dr. Michael Mosley, doesn\'t involve daily fasting windows. Instead, you eat normally for 5 days per week and restrict calories to 500-600 on the other 2 days (non-consecutive). This approach is easier for people who don\'t want a daily fasting schedule.',
                'how_it_works' => [
                    'Eat normally for 5 days per week',
                    'On 2 non-consecutive days, eat only 500-600 calories',
                    'Fasting days should not be back-to-back',
                    'No specific timing rules on normal days',
                    'Focus on protein and vegetables on fasting days to stay full',
                ],
                'sample_schedule' => [
                    'Monday' => 'Normal eating',
                    'Tuesday' => 'Fasting day — 500 cal (e.g., eggs for lunch, grilled fish + salad for dinner)',
                    'Wednesday' => 'Normal eating',
                    'Thursday' => 'Normal eating',
                    'Friday' => 'Fasting day — 500 cal',
                    'Saturday' => 'Normal eating',
                    'Sunday' => 'Normal eating',
                ],
                'benefits' => [
                    'Very flexible — no daily time restrictions',
                    'Easier socially — most days are normal',
                    'Still provides metabolic benefits of fasting',
                    'Research-backed for weight loss and longevity',
                    'Good entry point for fasting beginners',
                ],
                'tips' => [
                    'Don\'t compensate by overeating on normal days',
                    'High-protein foods on fasting days help with satiety',
                    'Schedule fasting days on less social days',
                    'Drink plenty of water on fasting days',
                ],
            ],
            'eat-stop-eat' => [
                'name' => 'Eat-Stop-Eat',
                'subtitle' => 'One or two 24-hour fasts per week',
                'fasting_hours' => 24,
                'eating_hours' => 0,
                'difficulty' => 'Intermediate',
                'color' => 'indigo',
                'summary' => 'Do one or two complete 24-hour fasts per week. Eat normally on all other days.',
                'description' => 'Created by Brad Pilon, Eat-Stop-Eat involves doing one or two complete 24-hour fasts per week. For example, you eat dinner on Monday and then don\'t eat again until dinner on Tuesday. On all other days, you eat normally. This is simpler than daily fasting for some people.',
                'how_it_works' => [
                    'Choose 1-2 days per week for a full 24-hour fast',
                    'Example: eat dinner Monday, fast until dinner Tuesday',
                    'Eat normally on all non-fasting days',
                    'Water, coffee, and tea during the fast',
                    'Don\'t do two fasting days in a row',
                ],
                'sample_schedule' => [
                    'Monday 7 PM' => 'Last meal (dinner)',
                    'Tuesday all day' => 'Fasting — water, coffee, tea only',
                    'Tuesday 7 PM' => 'Break fast with normal dinner',
                    'Wed-Sun' => 'Eat normally',
                ],
                'benefits' => [
                    'Full 24-hour autophagy activation',
                    'Only requires discipline 1-2 days per week',
                    'No calorie counting on eating days',
                    'Significant weekly calorie reduction',
                    'Can break weight loss plateaus',
                ],
                'tips' => [
                    'Break your fast with a normal-sized meal, not a feast',
                    'Stay busy on fasting days — boredom triggers hunger',
                    'Start with one 24-hour fast per week before adding a second',
                    'If you feel unwell, break the fast — there\'s always next week',
                ],
            ],
        ];
    }
}
