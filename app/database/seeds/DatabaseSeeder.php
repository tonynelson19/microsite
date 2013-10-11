<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        DB::table('sections')->delete();
        DB::table('categories')->delete();
        DB::table('products')->delete();
        DB::table('images')->delete();

        for ($i = 1; $i <= 6; $i++) {

            /** @var Section $section */
            $section = Section::create(array(
                 'name'     => 'Section ' . $i,
                 'imageUrl' => 'http://placekitten.com/224/130',
                 'status'   => Section::STATUS_ACTIVE,
                 'order'    => $i,
            ));

            for ($j = 1; $j <= 2; $j++) {

                /** @var Category $category */
                $category = Category::create(array(
                    'sectionId' => $section->id,
                    'name'      => 'Category ' . $i . '.' . $j,
                    'status'    => Category::STATUS_ACTIVE,
                    'order'     => $j,
                ));

                for ($k = 1; $k <= 6; $k++) {

                    /** @var Product $product */
                    $product = Product::create(array(
                        'categoryId'  => $category->id,
                        'name'        => 'Product ' . $i . '.' . $j . '.' . $k,
                        'imageUrl'    => 'http://placekitten.com/62/62',
                        'description' => '<p>Beef ribs consequat chicken adipisicing ut nostrud ut andouille leberkas in bacon. Ball tip occaecat sint consectetur nisi tempor jowl enim chuck shoulder leberkas shankle fatback turducken. Sausage pork loin kevin filet mignon sint boudin enim ad short loin qui est velit pancetta. Fatback chuck adipisicing pariatur quis rump t-bone consequat aliqua nulla pork tongue sunt laborum.</p><p>In capicola boudin nulla pork loin quis. Strip steak laborum in elit. Ribeye cupidatat in in pig cow shoulder laborum velit beef ribs, pork chop corned beef jerky magna laboris. Ground round dolore sausage cillum tongue. Quis excepteur pig id, turducken culpa laboris frankfurter. Nostrud sausage deserunt enim est biltong, kevin capicola leberkas pig brisket laborum boudin. Kielbasa shoulder aliquip mollit irure.</p>',
                        'status'      => Product::STATUS_ACTIVE,
                        'order'       => $k,
                    ));

                    for ($l = 1; $l <= 3; $l++) {

                        /** @var Image $image */
                        $image = Image::create(array(
                            'productId' => $product->id,
                            'imageUrl'  => 'http://placekitten.com/350/550',
                            'caption'   => 'Image ' . $i . '.' . $j . '.' . $k . '.' . $l,
                            'status'    => Image::STATUS_ACTIVE,
                            'order'     => $l,
                        ));

                    }

                }

            }

        }
	}

}