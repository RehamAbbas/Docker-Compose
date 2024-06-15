<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Content\ContentCreateRequest;
use App\Http\Requests\Dashboard\Content\ContentUpdateRequest;
use App\Services\Dashboard\ContentService;
use App\Services\Dashboard\CourseService;
use Exception;

class ContentController extends Controller
{
    private ContentService $contentService;
    private CourseService $courseService;

    public function __construct(ContentService $contentService, CourseService $courseService)
    {
        $this->contentService = $contentService;
        $this->courseService = $courseService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = $this->contentService->list();
        return view('dashboard.pages.contents.index', compact('contents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContentCreateRequest $request)
    {
        $validatedData = $request->validated();
        $this->contentService->create($validatedData);
        return redirect()->route('admin.contents.index')->with('success', 'Content created successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = $this->courseService->getAllCourses();
        return view('dashboard.pages.contents.create', compact('courses'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //$courses = $this->courseService->show($id);
        return view('dashboard.pages.contents.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $content = $this->contentService->findById($id);
        $courses = $this->courseService->getAllCourses();
        return view('dashboard.pages.contents.update', compact(
            'content', 'courses'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContentUpdateRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $this->contentService->update($validatedData);
            return redirect()->route('admin.contents.index')->with('success', 'Content updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->contentService->destroy($id);
            return redirect()->route('admin.contents.index')->with('success', 'Content deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.contents.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Accept the specified content.
     */
    public function acceptContent(string $id)
    {
        $this->contentService->accept($id);
        return redirect()->route('admin.contents.index')->with('success', 'Content accepted successfully.');
    }
}
