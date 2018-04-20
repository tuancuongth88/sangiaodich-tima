<?php namespace App\Http\Repositories\Frontends\News;

use App\Http\Repositories\Administrators\Repository;
use App\Models\News\News;
use App\Models\News\NewsCategory;
use App\Models\Services\Service;
use App\Models\Users\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Validator;

class NewsRepository extends Repository {

    function __construct(NewsCategory $category, News $news, ResponseService $response, Request $request, AuthService $auth, User $user, $companyId = 0, $perpages = 2, $current = 1) {
        $this->category = $category;
        $this->model    = $news;
        $this->user     = $user;
        $this->response = $response;
        $this->request  = $request;
        $this->auth     = $auth;
        $this->perpages = $perpages;
        $this->current  = $current;
    }

    public function getLatest() {
        return $this->model->approve()->orderBy(self::ID, 'desc')->take(5)->get();
    }

    public function getNewsByCategory() {
        // $category   = $this->category->slug($categorySlug)->first();
        $categoryId = ($this->request->has('id')) ? $this->request->input('id') : 1;
        $listData   = $this->model
            ->category($categoryId)
            ->approve()
            ->orderBy(self::ID, 'desc')
            ->where('is_hot', 0)
            ->paginate(20);
        $listLatest  = self::getLatest();
        $listService = Service::all();
        $listHot     = $this->model
            ->category($categoryId)
            ->approve()
            ->where('is_hot', 1)
            ->orderBy(self::ID, 'desc')->take(3)->get();
        $listFaqCategory = \App\Models\Faqs\FaqCategories::where('type', 1)
            ->orderBy(self::ID, 'desc')->take(5)->get();
        $listCategory = $this->category->all();
        return view('frontend.news.list', ['data' => $listData, 'latest' => $listLatest, 'list_service' => $listService, 'listHot' => $listHot, 'listFaqCategory' => $listFaqCategory, 'listCategory' => $listCategory]);
    }

    public function getDetail($slug) {
        $data            = $this->model->approve()->slug($slug)->first();
        $listLatest      = self::getLatest();
        $listService     = Service::all();
        $listFaqCategory = \App\Models\Faqs\FaqCategories::where('type', 1)
            ->orderBy(self::ID, 'desc')->take(5)->get();
        $listCategory = $this->category->all();
        return view('frontend.news.detail', ['data' => $data, 'latest' => $listLatest, 'list_service' => $listService, 'listFaqCategory' => $listFaqCategory, 'listCategory' => $listCategory]);
    }

    public function getViewMore() {
        $listData = $this->model
            ->category($this->request->input('category'))
            ->approve()
            ->orderBy(self::ID, 'desc')
            ->pagination($this->perpages, $this->request->input('next-page'))
            ->get();
        return view('frontend.news.block-list', ['data' => $listData]);
    }
}