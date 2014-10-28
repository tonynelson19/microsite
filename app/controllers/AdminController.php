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
        $section->order = count(Section::all()) + 1;

        $result = $this->processSectionForm($section);

        if ($result) {
            return Redirect::route('admin.edit-section', array('id' => $section->id));
        }

        $categories = array();

        return View::make('admin.add-section', array(
            'section'    => $section,
            'categories' => $categories,
        ));
    }

    public function editSectionAction($id)
    {
        /** @var Section $section */
        $section = Section::findOrFail($id);

        $result = $this->processSectionForm($section);

        if ($result) {
            return Redirect::route('admin.edit-section', array('id' => $section->id));
        }

        $categories = $section->categories()->ordered()->get();

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
        /** @var Section $section */
        $section = Section::findOrFail($id);

        $category = new Category();
        $category->order = count($section->categories) + 1;

        $result = $this->processCategoryForm($section, $category);

        if ($result) {
            return Redirect::route('admin.edit-category', array('id' => $category->id));
        }

        $products = array();

        return View::make('admin.add-category', array(
            'section'  => $section,
            'category' => $category,
            'products' => $products,
        ));
    }

    public function editCategoryAction($id)
    {
        /** @var Category $category */
        $category = Category::findOrFail($id);

        $section = $category->section;

        $result = $this->processCategoryForm($section, $category);

        if ($result) {
            return Redirect::route('admin.edit-category', array('id' => $category->id));
        }

        $products = $category->products()->ordered()->get();

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
        /** @var Category $category */
        $category = Category::findOrFail($id);

        $product = new Product();
        $product->order = count($category->products) + 1;

        $section = $category->section;

        $result = $this->processProductForm($category, $product);

        if ($result) {
            return Redirect::route('admin.edit-product', array('id' => $product->id));
        }

        $images = array();
        $videos = array();

        return View::make('admin.add-product', array(
            'section'  => $section,
            'category' => $category,
            'product'  => $product,
            'images'   => $images,
            'videos'   => $videos,
        ));
    }

    public function editProductAction($id)
    {
        /** @var Product $product */
        $product = Product::findOrFail($id);

        $category = $product->category;

        $section = $category->section;

        $result = $this->processProductForm($category, $product);

        if ($result) {
            return Redirect::route('admin.edit-product', array('id' => $product->id));
        }

        $images = $product->images()->ordered()->get();
        $videos = $product->videos()->ordered()->get();

        return View::make('admin.edit-product', array(
            'section'  => $section,
            'category' => $category,
            'product'  => $product,
            'images'   => $images,
            'videos'   => $videos,
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

    public function downloadImagesAction()
    {
        ini_set('memory_limit', '2G');

        /** @var Section $section */
        foreach (Section::all() as $section) {
            $section->imageUrl = $this->processImage($section->imageUrl, Section::IMAGE_WIDTH, Section::IMAGE_HEIGHT);
            $section->save();
        }

        /** @var Product $product */
        foreach (Product::all() as $product) {
            $product->imageUrl = $this->processImage($product->imageUrl, Product::IMAGE_WIDTH, Product::IMAGE_HEIGHT);
            $product->save();
        }

        /** @var Image $image */
        foreach (Image::all() as $image) {
            $image->imageUrl = $this->processImage($image->imageUrl, Image::IMAGE_WIDTH, Image::IMAGE_HEIGHT);
            $image->save();
        }

        return Redirect::route('admin.list-sections');
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

        /** @var Illuminate\Validation\Validator $validator */
        $validator = Validator::make(Input::all(), $rules);

        if (Request::isMethod('post') && $validator->passes()) {

            $section->order  = Input::get('order');
            $section->name   = Input::get('name');
            $section->status = Input::get('status');

            if (Input::hasFile('imageUpload')) {
                $section->imageUrl = $this->processUpload(Input::file('imageUpload'), Section::IMAGE_WIDTH, Section::IMAGE_HEIGHT);
            } else {
                $section->imageUrl = $this->processImage(Input::get('imageUrl'), Section::IMAGE_WIDTH, Section::IMAGE_HEIGHT);
            }

            $section->save();

            $categories = Input::get('categories');

            if (is_array($categories)) {

                foreach ($categories as $key => $value) {

                    /** @var Category $category */
                    $category = Category::find($key);
                    $category->order = (int) $value;
                    $category->save();

                }

            }

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

            $products = Input::get('products');

            if (is_array($products)) {

                foreach ($products as $key => $value) {

                    /** @var Product $product */
                    $product = Product::find($key);
                    $product->order = (int) $value;
                    $product->save();

                }

            }

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

        /** @var Illuminate\Validation\Validator $validator */
        $validator = Validator::make(Input::all(), $rules);

        if (Request::isMethod('post') && $validator->passes()) {

            $product->order       = Input::get('order');
            $product->name        = Input::get('name');
            $product->description = Input::get('description');
            $product->status      = Input::get('status');
            $product->madeInUsa   = (bool) Input::get('madeInUsa');

            if (Input::hasFile('imageUpload')) {
                $product->imageUrl = $this->processUpload(Input::file('imageUpload'), Product::IMAGE_WIDTH, Product::IMAGE_HEIGHT);
            } else {
                $product->imageUrl = $this->processImage(Input::get('imageUrl'), Product::IMAGE_WIDTH, Product::IMAGE_HEIGHT);
            }

            $category->products()->save($product);

            $images = Input::get('images');

            if (is_array($images)) {

                foreach ($images as $key => $value) {

                    /** @var Image $image */
                    $image = Image::find($key);

                    if (array_key_exists('delete', $value)) {

                        $image->delete();

                    } else {

                        $image->order    = (int) $value['order'];
                        $image->imageUrl = $this->processImage($value['imageUrl'], Image::IMAGE_WIDTH, Image::IMAGE_HEIGHT);
                        $image->caption  = $value['caption'];
                        $image->status   = $value['status'];

                        $image->save();

                    }

                }

            }

            foreach (Input::get('newImages') as $value) {

                if ($value['imageUrl']) {

                    $image = new Image();

                    $image->order    = (int) $value['order'];
                    $image->imageUrl = $this->processImage($value['imageUrl'], Image::IMAGE_WIDTH, Image::IMAGE_HEIGHT);
                    $image->caption  = $value['caption'];
                    $image->status   = $value['status'];

                    $product->images()->save($image);

                }

            }

            $videos = Input::get('videos');

            if (is_array($videos)) {

                foreach ($videos as $key => $value) {

                    /** @var Video $video */
                    $video = Video::find($key);

                    if (array_key_exists('delete', $value)) {

                        $video->delete();

                    } else {

                        $videoUrl = Video::getYouTubeUrl($value['videoUrl']);

                        $video->order    = (int) $value['order'];
                        $video->videoUrl = $videoUrl;
                        $video->caption  = $value['caption'];
                        $video->status   = $value['status'];

                        $video->save();

                    }

                }

            }

            foreach (Input::get('newVideos') as $value) {

                $videoUrl = Video::getYouTubeUrl($value['videoUrl']);

                if ($videoUrl) {

                    $video = new Video();

                    $video->order    = (int) $value['order'];
                    $video->videoUrl = $videoUrl;
                    $video->caption  = $value['caption'];
                    $video->status   = $value['status'];

                    $product->videos()->save($video);

                }

            }

        }

        Former::withRules($validator->getRules());
        Former::withErrors($validator);

        return $validator->passes();
    }

    /**
     * Process an update
     *
     * @param UploadedFile $file
     * @param int $maxWidth
     * @param int $maxHeight
     * @return string
     */
    protected function processUpload(UploadedFile $file, $maxWidth, $maxHeight)
    {
        $root = public_path();
        $path = $this->generatePath($file->getClientOriginalName(), $file->getClientOriginalExtension());
        $info = pathinfo($root . $path);

        $file->move($info['dirname'], $info['basename']);

        return $this->downloadImage(URL::to($path), $maxWidth, $maxHeight);
    }

    /**
     * Generate a unique file path
     *
     * @param string $name
     * @param string $extension
     * @return string
     */
    protected function generatePath($name, $extension)
    {
        $name    = $this->slugify(basename($name, '.' . pathinfo($name, PATHINFO_EXTENSION)));
        $root    = public_path();
        $path    = strtolower('/uploads/' . $name . '.' . $extension);
        $version = 0;

        while (true) {
            if (!file_exists($root . $path)) {
                break;
            }

            $version++;
            $path = '/uploads/' . $name . '-' . $version . '.' . $extension;
        }

        return $path;
    }

    /**
     * Process an image
     *
     * @param string $url
     * @param int $width
     * @param int $height
     * @return string
     */
    protected function processImage($url, $width, $height)
    {
        if ($this->isRemoteImage($url)) {
            return $this->downloadImage($url, $width, $height);
        }
        return $url;
    }

    /**
     * Check if a image is remote
     *
     * @param string $url
     * @return bool
     */
    protected function isRemoteImage($url)
    {
        $url = trim(strtolower($url));

        if ($url == '') {
            return false;
        }

        $local = URL::to('/');

        if (substr($url, 0, strlen($local)) === $local) {
            return false;
        }

        if (in_array($this->getExtension($url), array('jpg', 'png'))) {
            return true;
        }

        return false;
    }

    /**
     * Download an image
     *
     * @param string $url
     * @param int $maxWidth
     * @param int $maxHeight
     * @return string
     */
    protected function downloadImage($url, $maxWidth, $maxHeight)
    {
        $extension    = $this->getExtension($url);
        $sourceSize   = getimagesize($url);
        $sourceWidth  = $sourceSize[0];
        $sourceHeight = $sourceSize[1];
        $sourceRatio  = $sourceWidth / $sourceHeight;
        $maxRatio     = $maxWidth / $maxHeight;

        if ($sourceWidth <= $maxWidth && $sourceHeight <= $maxHeight) {
            $width  = $sourceWidth;
            $height = $sourceHeight;
        } elseif ($maxRatio > $sourceRatio) {
            $width  = (int) ($maxHeight * $sourceRatio);
            $height = $maxHeight;
        } else {
            $width  = $maxWidth;
            $height = (int) ($maxWidth / $sourceRatio);
        }

        if ($extension == 'png') {
            $source = imagecreatefrompng($url);
        } else {
            $source = imagecreatefromjpeg($url);
        }

        $image = imagecreatetruecolor($width, $height);
        imagealphablending($image, false);
        imagesavealpha($image, true);
        imagefill($image, 0, 0, imagecolorallocatealpha($image, 255, 255, 255, 127)); // fill the background with white
        imagecopyresampled($image, $source, 0, 0, 0, 0, $width, $height, $sourceWidth, $sourceHeight);

        $path = $this->generatePath($url, $extension);
        $file = public_path() . $path;

        if ($extension == 'png') {
            imagepng($image, $file, 9);
        } else {
            imagejpeg($image, $file, 100);
        }

        imagedestroy($image);
        imagedestroy($source);

        return URL::to($path);
    }

    /**
     * Get the extension for a URL
     *
     * @param string $url
     * @return string|null
     */
    protected function getExtension($url)
    {
        $url = trim(strtolower($url));

        if ($url == '') {
            return null;
        }

        return pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
    }

    /**
     * Slugify text
     *
     * @param string $text
     * @return string
     */
    public function slugify($text)
    {
        $text = strtolower(trim($text));

        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}