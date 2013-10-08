<?php
class IndexController extends BaseController
{
    public function indexAction()
    {
        $sections = Section::active()->ordered()->get();

        return View::make('index.index', array(
            'sections' => $sections,
        ));
    }

    public function sectionAction($id)
    {
        /** @var Section $section */
        $section = Section::findOrFail($id);

        $categories = $section->categories()->active()->ordered()->get();

        $products = array();
        foreach ($categories as $category) {
            $products[$category->id] = $category->products()->active()->ordered()->get();
        }

        return View::make('index.section', array(
            'section'    => $section,
            'categories' => $categories,
            'products'   => $products,
        ));
    }

    public function productAction($id)
    {
        $product = Product::findOrFail($id);

        $images = $product->images()->active()->ordered()->get();

        return View::make('index.product', array(
            'product' => $product,
            'images' => $images,
        ));
    }
}