<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\TeachingMaterial;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\SectionResource;
use App\Http\Resources\TeachingMaterialResource;

class SectionController extends Controller
{
    public function getsections()
    {
        $user=Auth::user();

       
        $curriculumIds = \DB::table('batch_users')
            ->join('batch_curriculum', 'batch_users.batch_id', '=', 'batch_curriculum.batch_id')
            ->where('batch_users.user_id', $user->id)
            ->pluck('batch_curriculum.curriculum_id');

        // Get sections related to those curriculums
            $sections = Section::whereIn('curriculum_id', $curriculumIds)
                ->get();
       

        if ($sections->isEmpty()) {
            return response()->json(['message' => 'No sections available for your enrolled batches.'], 200);
        }

        return SectionResource::collection($sections);
    }

    public function GetTeachingMaterial(Request $request)
    {
        $request->validate([
            'id' => 'required'            
        ]);

        $Id=$request->input('id');
        $teaching_material=TeachingMaterial::where('section_id',$Id)
                                            ->where('published', true)
                                            ->get();
        // if ($teaching_material->isEmpty()) {
        // return response()->json(['message' => 'No teaching material available for your enrolled batches.'], 200);
        // }
        return TeachingMaterialResource::collection($teaching_material);
    }   
    
}
