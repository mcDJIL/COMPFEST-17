<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::where('rating', '>=', 4)
        ->inRandomOrder()
        ->take(5)
        ->get();

        return response()->json([
            'status' => true,
            'message' => 'Testimonials successfully retrieved.',
            'data' => $testimonials
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'review' => 'required|min:10|max:180',
            'rating' => 'required|integer',
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null
            ], 422);
        }

        $testimonial = Testimonial::create([
            'name' => $request->name,
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Testimonial sent successfully.',
            'data' => $testimonial
        ], 201);
    }

    public function getSummaryReview()
    {
        $testimonials = Testimonial::get();

        $totalReview = $testimonials->count();
        $ratingAverage = $testimonials->average('rating');
        $summaryReview = $this->summaryReview($ratingAverage);

        $data = [
            'total_review' => $totalReview,
            'rating_average' => $ratingAverage,
            'summary_review' => $summaryReview,
        ];

        return response()->json([
            'status' => true,
            'message' => 'Summary testimonials successfully retrieved.',
            'data' => $data
        ], 200);
    }

    protected function summaryReview($ratingAverage)
    {
        if ($ratingAverage >= 4.5) {
            return 'Excellent';
        } elseif ($ratingAverage >= 3.5) {
            return 'Good';
        } elseif ($ratingAverage >= 2.5) {
            return 'Average';
        } elseif ($ratingAverage > 0) {
            return 'Poor';
        } else {
            return 'Not reviewed yet';
        }
    }
}
