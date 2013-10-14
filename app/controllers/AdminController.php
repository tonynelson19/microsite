<?php
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AdminController extends BaseController
{
    public function indexAction()
	{
        if (Request::isMethod('post')) {

            /** @var Illuminate\Validation\Validator $validator */
            $validator = Validator::make(Input::all(), array(
                'username' => 'required',
                'password' => 'required',
            ));

            if ($validator->passes()) {

                $credentials = array(
                    'username' => Input::get('username'),
                    'password' => Input::get('password'),
                );

                if (Auth::attempt($credentials, true)) {

                    return Redirect::route('admin.list-sections');

                } else {

                    $validator->messages()->add('username', 'Invalid username or password');

                }

            }

            Former::withErrors($validator);

        }

        return View::make('admin.index');
	}

    public function logoutAction()
    {
        Auth::logout();

        return Redirect::route('admin.index');
    }

    public function listSectionsAction()
    {
        $sections = Section::ordered()->get();

        return View::make('admin.list-sections', array(
            'sections' => $sections,
        ));
    }

    public function addSectionAction()
    {
        $section = new Section();

        $result = $this->processSectionForm($section);

        if ($result) {
            return Redirect::route('admin.edit-section', array('id' => $section->id));
        }

        return View::make('admin.add-section', array(
            'section' => $section,
        ));
    }

    public function editSectionAction($id)
    {
        /** @var Section $section */
        $section = Section::findOrFail($id);

        $categories = $section->categories()->ordered()->get();

        $result = $this->processSectionForm($section);

        if ($result) {
            return Redirect::route('admin.edit-section', array('id' => $section->id));
        }

        return View::make('admin.edit-section', array(
            'section'    => $section,
            'categories' => $categories,
        ));
    }

    public function deleteSectionAction($id)
    {
        /** @var Section $section */
        $section = Section::findOrFail($id);

        $section->delete();

        return Redirect::route('admin.list-sections');
    }

    public function addCategoryAction($id)
    {
        $section = Section::findOrFail($id);

        $category = new Category();

        $result = $this->processCategoryForm($section, $category);

        if ($result) {
            return Redirect::route('admin.edit-category', array('id' => $category->id));
        }

        return View::make('admin.add-category', array(
            'section'  => $section,
            'category' => $category,
        ));
    }

    public function editCategoryAction($id)
    {
        /** @var Category $category */
        $category = Category::findOrFail($id);

        $section = $category->section;

        $result = $this->processCategoryForm($section, $category);

        $products = $category->products()->ordered()->get();

        if ($result) {
            return Redirect::route('admin.edit-category', array('id' => $category->id));
        }

        return View::make('admin.edit-category', array(
            'section'  => $section,
            'category' => $category,
            'products' => $products,
        ));
    }

    public function deleteCategoryAction($id)
    {
        /** @var Category $category */
        $category = Category::findOrFail($id);

        $section = $category->section;

        $category->delete();

        return Redirect::route('admin.edit-section', array('id' => $section->id));
    }

    public function addProductAction($id)
    {
        $product = new Product();

        $category = Category::findOrFail($id);

        $section = $category->section;

        $result = $this->processProductForm($category, $product);

        if ($result) {
            return Redirect::route('admin.edit-product', array('id' => $product->id));
        }

        return View::make('admin.add-product', array(
            'section'  => $section,
            'category' => $category,
            'product'  => $product,
        ));
    }

    public function editProductAction($id)
    {
        $product = Product::findOrFail($id);

        $category = $product->category;

        $section = $category->section;

        $images = $product->images()->ordered()->get();

        $result = $this->processProductForm($category, $product);

        if ($result) {
            return Redirect::route('admin.edit-product', array('id' => $product->id));
        }

        return View::make('admin.edit-product', array(
            'section'  => $section,
            'category' => $category,
            'product'  => $product,
            'images'   => $images,
        ));
    }

    public function deleteProductAction($id)
    {
        /** @var Product $product */
        $product = Product::findOrFail($id);

        $category = $product->category;

        $product->delete();

        return Redirect::route('admin.edit-category', array('id' => $category->id));
    }

    public function saveProductImagesAction($id)
    {
        /** @var Product $product */
        $product = Product::findOrFail($id);

        $images = Input::get('images');

        if (is_array($images)) {

            foreach ($images as $key => $value) {

                /** @var Image $image */
                $image = Image::find($key);

                if (array_key_exists('delete', $value)) {

                    $image->delete();

                } else {

                    $image->order    = (int) $value['order'];
                    $image->imageUrl = $value['imageUrl'];
                    $image->caption  = $value['caption'];
                    $image->status   = $value['status'];

                    $image->save();

                }

            }

        }

        foreach (Input::get('new') as $value) {

            if ($value['imageUrl']) {

                $image = new Image();

                $image->order    = (int) $value['order'];
                $image->imageUrl = $value['imageUrl'];
                $image->caption  = $value['caption'];
                $image->status   = $value['status'];

                $product->images()->save($image);

            }

        }

        return Redirect::route('admin.edit-product', array('id' => $product->id));
    }

    /**
     * Process the section form
     *
     * @param Section $section
     * @return bool
     */
    protected function processSectionForm(Section $section)
    {
        $rules = array(
            'order' => 'required|numeric',
            'name'  => 'required',
        );

        if (!$section->id) {
            $rules['image'] = 'required';
        }

        /** @var Illuminate\Validation\Validator $validator */
        $validator = Validator::make(Input::all(), $rules);

        if (Request::isMethod('post') && $validator->passes()) {

            $section->order  = Input::get('order');
            $section->name   = Input::get('name');
            $section->status = Input::get('status');

            if (Input::hasFile('image')) {
                $section->imageUrl = $this->processUpload(Input::file('image'));
            }

            $section->save();

        }

        Former::withRules($validator->getRules());
        Former::withErrors($validator);

        return $validator->passes();
    }

    /**
     * Process the category form
     *
     * @param Section $section
     * @param Category $category
     * @return bool
     */
    protected function processCategoryForm(Section $section, Category $category)
    {
        $rules = array(
            'order' => 'required|numeric',
            'name'  => 'required',
        );

        /** @var Illuminate\Validation\Validator $validator */
        $validator = Validator::make(Input::all(), $rules);

        if (Request::isMethod('post') && $validator->passes()) {

            $category->order  = Input::get('order');
            $category->name   = Input::get('name');
            $category->status = Input::get('status');

            $section->categories()->save($category);

        }

        Former::withRules($validator->getRules());
        Former::withErrors($validator);

        return $validator->passes();
    }

    /**
     * Process the product form
     *
     * @param Category $category
     * @param Product $product
     * @return bool
     */
    protected function processProductForm(Category $category, Product $product)
    {
        $rules = array(
            'order' => 'required|numeric',
            'name'  => 'required',
        );

        if (!$product->id) {
            $rules['image'] = 'required';
        }

        /** @var Illuminate\Validation\Validator $validator */
        $validator = Validator::make(Input::all(), $rules);

        if (Request::isMethod('post') && $validator->passes()) {

            $product->order       = Input::get('order');
            $product->name        = Input::get('name');
            $product->videoUrl    = Input::get('videoUrl');
            $product->description = Input::get('description');
            $product->status      = Input::get('status');

            if (Input::hasFile('image')) {
                $product->imageUrl = $this->processUpload(Input::file('image'));
            }

            $category->products()->save($product);

        }

        Former::withRules($validator->getRules());
        Former::withErrors($validator);

        return $validator->passes();
    }

    /**
     * Process an update
     *
     * @param UploadedFile $file
     * @return string
     */
    protected function processUpload(UploadedFile $file)
    {
        $root = public_path();
        $path = $this->generateUploadPath($root, $file);
        $info = pathinfo($root . $path);
        $url  = URL::to($path);

        $file->move($info['dirname'], $info['basename']);

        return $url;
    }

    /**
     * Generate a path for an uploaded file
     *
     * @param string $root
     * @param UploadedFile $file
     * @return string
     */
    protected function generateUploadPath($root, UploadedFile $file)
    {
        $parts     = explode('.', $file->getClientOriginalName());
        $name      = $parts[0];
        $extension = $file->getClientOriginalExtension();
        $path      = '/uploads/' . $name . '.' . $extension;
        $version   = 0;

        while (true) {

            if (!file_exists($root . $path)) {
                break;
            }

            $version++;
            $path = '/uploads/' . $name . '-' . $version . '.' . $extension;
        }

        return $path;
    }
}