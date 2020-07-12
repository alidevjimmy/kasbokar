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
        $catagories = \App\Category::latest()->get();
        return view('admin.pages.content.create', ['type' => $request->type, 'categories' => $catagories]);
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
    public function edit(Request $request, Content $content)
    {
        $categories = \App\Category::latest()->get();
        return view('admin.pages.content.edit', ['content' => $content, 'type' => $request->type , 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Content $content
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Content $content)
    {
        $request->validate([
            'type' => 'in:' . self::TYPES,
        ]);
        switch ($request->type) {
            case 'EVENT':
                return $this->updateEvent($content, $request);
                break;
            case 'PREREQUISITES':
                return $this->updatePrerequisites($content, $request);
                break;
            case 'STEP':
                return $this->updateStep($content, $request);
                break;
            case 'INTRODUCTION':
                return $this->updateIntroduction($content, $request);
                break;
            case 'JANEBI':
                return $this->updateJanebi($content, $request);
                break;
        }
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
            'category_id' => 'required',
            'body' => 'required',
            'preImage' => 'required|mimes:jpg,png,jpeg',
            'video' => 'required|mimes:mp4,wmv,mpg,flv'
        ]);
        $type = 'EVENT';


        $preImage = $this->uploadImage($request, 'preImage');
        $validatedData['preImage'] = $preImage;
        $video = $this->uploadVideo($request, 'video');
        $validatedData['video'] = $video;

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
            'body' => 'required',
            'video' => 'required|mimes:mp4,wmv,mpg,flv',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);
        $type = 'PREREQUISITES';
        $image = $this->uploadImage($request , 'image');
        $video = $this->uploadVideo($request, 'video');
        $validatedData['video'] = $video;
        $validatedData['image'] = $image;
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
            'category_id' => 'required',
            'body' => 'required',
            'shouldJobs' => 'array',
            'preImage' => 'required|mimes:jpg,png,jpeg',
            'banerImage' => 'required|mimes:jpg,png,jpeg',
            'video' => 'required|mimes:mp4,wmv,mpg,flv',
        ]);
        $shouldJobs = json_encode($request->shouldJobs);
        $validatedData['shouldJobs'] = $shouldJobs;
        $type = 'STEP';

        $preImage = $this->uploadImage($request, 'preImage');
        $banerImage = $this->uploadImage($request, 'banerImage');
        $video = $this->uploadVideo($request, 'video');
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
            'preImage' => 'required|mimes:jpg,png,jpeg',
            'banerImage' => 'required|mimes:jpg,png,jpeg',
            'video' => 'required|mimes:mp4,wmv,mpg,flv',
        ]);
        $type = 'JANEBI';

        $preImage = $this->uploadImage($request, 'preImage');
        $banerImage = $this->uploadImage($request, 'banerImage');
        $video = $this->uploadVideo($request, 'video');
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
        $type = 'INTRODUCTION';
        $logo = $this->uploadImage($request, 'logo');
        $validatedData['logo'] = $logo;
        $validatedData['type'] = $type;
        Content::create($validatedData);
        return redirect(route('admin.content.index', ['type' => $type]))->with([
            'status' => 'success',
            'message' => 'محتوای معرفی کسب و کار اضافه شد'
        ]);
    }

    protected function updateEvent($content, $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'body' => 'required',
            'preImage' => 'mimes:jpg,png,jpeg',
            'video' => 'mimes:mp4,wmv,mpg,flv',
        ]);
        $type = 'EVENT';
        if ($request->preImage) {
            $preImage = $this->uploadImage($request, 'preImage');
            $validatedData['preImage'] = $preImage;
        }
        if ($request->video) {
            $video = $this->uploadVideo($request, 'video');
            $validatedData['video'] = $video;
        }
        $validatedData['type'] = $type;
        $content->update($validatedData);
        return redirect(route('admin.content.index', ['type' => $type]))->with([
            'status' => 'success',
            'message' => 'چالش ویرایش شد'
        ]);
    }

    protected function updatePrerequisites($content, $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'video' => 'mimes:mp4,wmv,mpg,flv',
            'image' => 'mimes:jpeg,png,jpg'
        ]);
        $type = 'PREREQUISITES';
        if ($request->video) {
            $video = $this->uploadVideo($request, 'video');
            $validatedData['video'] = $video;
        }
        if ($request->image) {
            $image = $this->uploadImage($request, 'image');
            $validatedData['image'] = $image;
        }
        $validatedData['type'] = $type;
        $content->update($validatedData);
        return redirect(route('admin.content.index', ['type' => $type]))->with([
            'status' => 'success',
            'message' => 'پیش نیاز ویرایش شد'
        ]);
    }

    protected function updateStep($content, $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'shortText' => 'required',
            'category_id' => 'required',
            'body' => 'required',
            'shouldJobs' => 'array',
            'preImage' => 'mimes:jpg,png,jpeg',
            'banerImage' => 'mimes:jpg,png,jpeg',
            'video' => 'mimes:mp4,wmv,mpg,flv',
        ]);
        $shouldJobs = json_encode($request->shouldJobs);
        $validatedData['shouldJobs'] = $shouldJobs;
        $type = 'STEP';
        if ($request->preImage) {
            $preImage = $this->uploadImage($request, 'preImage');
            $validatedData['preImage'] = $preImage;
        }
        if ($request->banerImage) {
            $banerImage = $this->uploadImage($request, 'banerImage');
            $validatedData['banerImage'] = $banerImage;
        }
        $validatedData['type'] = $type;
        if ($request->video) {
            $video = $this->uploadVideo($request, 'video');
            $validatedData['video'] = $video;
        }
        $content->update($validatedData);
        return redirect(route('admin.content.index', ['type' => $type]))->with([
            'status' => 'success',
            'message' => 'محتوای مرحله ای ویرایش شد'
        ]);
    }

    protected function updateJanebi($content, $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'shortText' => 'required',
            'body' => 'required',
            'preImage' => 'mimes:jpg,png,jpeg',
            'banerImage' => 'mimes:jpg,png,jpeg',
            'video' => 'mimes:mp4,wmv,mpg,flv',
        ]);
        $type = 'JANEBI';
        if ($request->preImage) {
            $preImage = $this->uploadImage($request, 'preImage');
            $validatedData['preImage'] = $preImage;
        }
        if ($request->banerImage) {
            $banerImage = $this->uploadImage($request, 'banerImage');
            $validatedData['banerImage'] = $banerImage;
        }
        if ($request->video) {
            $video = $this->uploadVideo($request, 'video');
            $validatedData['video'] = $video;
        }
        $validatedData['type'] = $type;
        $content->update($validatedData);
        return redirect(route('admin.content.index', ['type' => $type]))->with([
            'status' => 'success',
            'message' => 'محتوای جانبی ویرایش شد'
        ]);
    }

    protected function updateIntroduction($content, $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'logo' => 'mimes:jpg,png,jpeg',
        ]);
        $type = 'INTRODUCTION';
        if ($request->logo) {
            $logo = $this->uploadImage($request, 'logo');
            $validatedData['logo'] = $logo;
        }
        $validatedData['type'] = $type;
        $content->update($validatedData);
        return redirect(route('admin.content.index', ['type' => $type]))->with([
            'status' => 'success',
            'message' => 'محتوای معرفی کسب و کار ویرایش شد'
        ]);
    }

    public function uploadImage($request, $fieldName)
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
