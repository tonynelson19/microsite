<?php
class AdminController extends BaseController
{
    public function indexAction()
	{
        $user = User::find(1);

        return View::make('admin.index', array(
            'user' => $user,
        ));
	}
}