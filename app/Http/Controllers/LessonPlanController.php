<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\LessonPlan;
use Illuminate\Http\Request;

class LessonPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Course $course
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        return view('lesson.create', [
            'course' => $course
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Course $course
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Course $course, Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'content' => ['required']
        ]);

        $course->lessons()->create($validatedData);

        session()->flash('successMessage', 'Plano ' . $validatedData['name'] . ' foi criado com sucesso!');

        return redirect()->route('course.show', ['course' => $course]);
    }

    /**
     * Display the specified resource.
     *
     * @param Course $course
     * @param \App\Models\LessonPlan $lessonPlan
     * @return \Illuminate\Http\Response
     */
    public function show(LessonPlan $lessonPlan)
    {
        return view('lesson.lesson', [
            'lesson' => $lessonPlan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\LessonPlan $lessonPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(LessonPlan $lessonPlan)
    {
        return view('lesson.edit', [
            'lesson' => $lessonPlan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\LessonPlan $lessonPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LessonPlan $lessonPlan)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'content' => ['required']
        ]);

        $lessonPlan->name = $validatedData['name'];
        $lessonPlan->description = $validatedData['description'];
        $lessonPlan->content = $validatedData['content'];
        $lessonPlan->save();

        return redirect()->route('lessons.show', $lessonPlan->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\LessonPlan $lessonPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(LessonPlan $lessonPlan)
    {
        //
    }
}
