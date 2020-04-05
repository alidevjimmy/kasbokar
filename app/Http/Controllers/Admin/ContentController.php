<?php

namespace App\Http\Controllers\Admin;

use App\Content;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentController extends Controller
{
    const TYPES = "EVENT,PREREQUISITES,STEP,INTRODUCTION,JANEBI";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $request->validate([
            'type' => "in:" . self::TYPES
        ]);
        $contents = Content::where('type', $request->type)->latest()->get();
        return view('admin.pages.content.index', ['contents' => $contents, 'type' => $request->type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $request->validate([
            'type' => "in:" . self::TYPES
        ]);
        return view('admin.pages.content.create', ['type' => $request->type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'in:' . self::TYPES,
        ]);
        switch ($request->type) {
            case 'EVENT':
                return $this->storeEvent($request);
                break;
            case 'PREREQUISITES':
                return $this->storePrerequisites($request);
                break;
            case 'STEP':
                return $this->storeStep($request);
                break;
            case 'INTRODUCTION':
                return $this->storeIntroduction($request);
                break;
            case 'JANEBI':
                return $this->storeJanebi($request);
                break;
        };
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Content $content
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Content $content)
    {
        return view('admin.pages.contents.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Content $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Content $content
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Request $request, Content $content)
    {
        $content->delete();
        return redirect(route('admin.content.index', ['type' => $request->type]))->with([
            'status' => 'success',
            'message' => 'محتوا حذف شد.',
            'statusCode' => Response::HTTP_NO_CONTENT
        ]);
    }

    public function whichContent()
    {
        return view('admin.pages.whichContent');
    }

    protected function storeEvent($request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'level' => 'required',
            'body' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg'
        ]);
        $type = 'EVENT';
        $image = $this->uploadImage($request, 'image');
        $validatedData['image'] = $image;
        $validatedData['type'] = $type;
        Content::create($validatedData);
        return redirect(route('admin.content.index', ['type' => $type]))->with([
            'status' => 'success',
            'message' => 'چالش اضافه شد'
        ]);
    }

    protected function storePrerequisites($request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'level' => 'required',
            'body' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg',
            'video' => 'required|mimes:mp4,wmv,mpg,flv'
        ]);
        $type = 'PREREQUISITES';
        $image = $this->uploadImage($request, 'image');
        $video = $this->uploadVideo($request, 'video');
        $validatedData['image'] = $image;
        $validatedData['video'] = $video;
        $validatedData['type'] = $type;
        Content::create($validatedData);
        return redirect(route('admin.content.index', ['type' => $type]))->with([
            'status' => 'success',
            'message' => 'پیش نیاز اضافه شد'
        ]);
    }

    protected function storeStep($request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'shortText' => 'required',
            'level' => 'required',
            'body' => 'required',
            'shouldJobs' => 'required|array',
            'image' => 'required|mimes:jpg,png,jpeg',
            'preImage' => 'required|mimes:jpg,png,jpeg',
            'banerImage' => 'required|mimes:jpg,png,jpeg',
            'video' => 'required|mimes:mp4,wmv,mpg,flv',
        ]);
        $shouldJobs = json_encode($request->shouldJobs);
        $validatedData['shouldJobs'] = $shouldJobs;
        $type = 'STEP';
        $image = $this->uploadImage($request, 'image');
        $preImage = $this->uploadImage($request, 'preImage');
        $banerImage = $this->uploadImage($request, 'banerImage');
        $video = $this->uploadVideo($request, 'video');
        $validatedData['image'] = $image;
        $validatedData['preImage'] = $preImage;
        $validatedData['banerImage'] = $banerImage;
        $validatedData['video'] = $video;
        $validatedData['type'] = $type;
        Content::create($validatedData);
        return redirect(route('admin.content.index', ['type' => $type]))->with([
            'status' => 'success',
            'message' => 'محتوای مرحله ای اضافه شد'
        ]);
    }

    protected function storeJanebi($request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'shortText' => 'required',
            'body' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg',
            'preImage' => 'required|mimes:jpg,png,jpeg',
            'banerImage' => 'required|mimes:jpg,png,jpeg',
            'video' => 'required|mimes:mp4,wmv,mpg,flv',
        ]);
        $type = 'JANEBI';
        $image = $this->uploadImage($request, 'image');
        $preImage = $this->uploadImage($request, 'preImage');
        $banerImage = $this->uploadImage($request, 'banerImage');
        $video = $this->uploadVideo($request, 'video');
        $validatedData['image'] = $image;
        $validatedData['preImage'] = $preImage;
        $validatedData['banerImage'] = $banerImage;
        $validatedData['video'] = $video;
        $validatedData['type'] = $type;
        Content::create($validatedData);
        return redirect(route('admin.content.index', ['type' => $type]))->with([
            'status' => 'success',
            'message' => 'محتوای جانبی اضافه شد'
        ]);
    }

    protected function storeIntroduction($request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'logo' => 'required|mimes:jpg,png,jpeg',
        ]);
        $type = 'JANEBI';
        $logo = $this->uploadImage($request, 'logo');
        $validatedData['logo'] = $logo;
        $validatedData['type'] = $type;
        Content::create($validatedData);
        return redirect(route('admin.content.index', ['type' => $type]))->with([
            'status' => 'success',
            'message' => 'محتوای معرفی کسب و کار اضافه شد'
        ]);
    }

    protected function uploadImage($request, $fieldName)
    {
        $fileName = time() . '_' . $fieldName . '.' . $request->file($fieldName)->extension();
        $request->file($fieldName)->move(public_path('uploads/images'), $fileName);
        return '/uploads/images/' . $fileName;
    }

    protected function uploadVideo($request, $fieldName)
    {
        $fileName = time() . '.' . $request->file($fieldName)->extension();
        $request->file($fieldName)->move(public_path('uploads/videos'), $fileName);
        return '/uploads/videos/' . $fileName;
    }
}
