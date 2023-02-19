<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $testimonials = Testimonial::where('is_active', 1)->latest('id')
                        ->limit(3)
                        ->select(['id', 'client_name', 'client_designation', 'client_message', 'client_image'])
                        ->get();


        $categories = Category::where('is_active', 1)->latest('id')
                      ->limit(5)
                      ->select(['id', 'title', 'slug', 'category_image'])
                      ->get();

        return view('forntend.pages.home', compact('testimonials', 'categories'));
    }
}
