<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Interfaces\ICategoryRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    private $categoryRepository;

    public function __construct(ICategoryRepositoryInterface $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->getCategoriesListForCategories();

        if (View::exists('dashboard.pages.category-index')){
            return \view('dashboard.pages.category-index' , compact('categories'));
        }
        abort(404);
    }


    public function productCategories()
    {
        $categories = $this->categoryRepository->getCategoriesListForProductCategories();

        if (View::exists('dashboard.pages.product-categories')){
            return \view('dashboard.pages.product-categories' , compact('categories'));
        }
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = $this->categoryRepository->getCategoriesListForCategories();

        if (View::exists('dashboard.pages.category-create')){
            return \view('dashboard.pages.category-create' , compact('categories'));
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryFormRequest $request)
    {
        $validated = $request->validated();

        if ($validated){

            if (isset($validated['category_image'])){

                $extension = $validated['category_image']->extension();
                $imagePath = $validated['category_image']->storeAs('categories' , Str::slug($validated['category_name']).'.'.$extension);

                $validated['category_image'] = $imagePath;
            }

            $newCat = $this->categoryRepository->getModel()::create($validated);

            if ($newCat) return redirect()->route('dashboard.categories.index')->with('category_status' , 'Category successful created!');
            return redirect()->route('dashboard.categories.index')->with('category_status' , 'Error create category!')
                ->with('category_error' , true);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        $categories = $this->categoryRepository->getCategoriesListForCategories();

        if (View::exists('dashboard.pages.category-edit')){
            return \view('dashboard.pages.category-edit' , compact('category' , 'categories'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryFormRequest $request, $id)
    {
        $category = $this->categoryRepository->find($id);
        if (!$category) abort(404);

        $validated = $request->validated();

        if ($validated){

            $update = $category->update($validated);

            if ($update) return redirect()->route('dashboard.categories.index' , ['category' => $id])->with('category_status' , 'Category successful update!');
            return redirect()->route('dashboard.categories.edit' , ['category' => $category->id])->with('category_status' , 'Error update category!')
                ->with('category_error' , true);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->find($id);
        if (!$category) return back();

        $delete = $category->delete();
        Storage::delete($category->category_image);

        if ($delete) return back()->with('category_status' , 'Category successful delete!');
        return back()->with('category_status' , 'Error delete category!')
            ->with('category_error' , true);
    }
}
