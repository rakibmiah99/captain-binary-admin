<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Problem;
use App\Helper;
class ProblemObserver
{
    /**
     * Handle the Problem "created" event.
     */
    public function created(Problem $problem): void
    {
        try{
            $category_wise_problem = Problem::where('category_id', $problem->category_id)->count();
            $problem->category->update(['itemTotal' => $category_wise_problem]);
        }
        catch(\Exception $e){
            dd($e->getMessage());
        }

    }

    /**
     * Handle the Problem "updated" event.
     */
    public function updated(Problem $problem): void
    {
        try{
            $is_change_category = array_key_exists('category_id', $problem->getChanges());
            if($is_change_category){
                //old category Item total Changed
                $original_category_id = $problem->getOriginal('category_id');
                $original_category_problem_count = Problem::where('category_id', $original_category_id)->count();
                Category::where('id', $original_category_id)->update(['itemTotal'=> $original_category_problem_count]);

                //new category item total change 
                $category_wise_problem = Problem::where('category_id', $problem->category_id)->count();
                $problem->category->update(['itemTotal' => $category_wise_problem]);
            }
        }
        catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    /**
     * Handle the Problem "deleted" event.
     */
    public function deleted(Problem $problem): void
    {
        try{
            $category_wise_problem = Problem::where('category_id', $problem->category_id)->count();
            $problem->category->update(['itemTotal' => $category_wise_problem]);
            // Helper::RemoveFile($problem->details?->instructions_bn);
            // Helper::RemoveFile($problem->details?->instructions);
            
        }
        catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    /**
     * Handle the Problem "restored" event.
     */
    public function restored(Problem $problem): void
    {
        //
    }

    /**
     * Handle the Problem "force deleted" event.
     */
    public function forceDeleted(Problem $problem): void
    {
        //
    }
}
