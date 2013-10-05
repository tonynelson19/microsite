<?php
class IndexController extends BaseController
{
    public function indexAction()
	{
        return View::make('index.index');
	}

    public function sectionsAction()
    {
        $sections = Section::orderBy('order', 'asc')->get();

        return View::make('index.sections', array(
            'sections' => $sections,
        ));
    }

    public function sectionAction($id)
    {
        $section = Section::find($id);

        return View::make('index.section', array(
            'section' => $section,
        ));
    }

    public function productAction($id)
    {
        $product = Product::find($id);

        return View::make('index.product', array(
           'product' => $product,
        ));
    }
}