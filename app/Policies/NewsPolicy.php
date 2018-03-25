<?php

namespace App\Policies;

use App\Models\News\News;
use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy {
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the news.
     *
     * @param  \App\Models\Users\User  $user
     * @param  \App\News  $news
     * @return mixed
     */
    public function view(User $user, News $news) {
        //
    }

    /**
     * Determine whether the user can create news.
     *
     * @param  \App\Models\Users\User  $user
     * @return mixed
     */
    public function create(User $user) {
        //
    }

    /**
     * Determine whether the user can update the news.
     *
     * @param  \App\Models\Users\User  $user
     * @param  \App\News  $news
     * @return mixed
     */
    public function update(User $user, News $news) {
        return $user->id === $news->created_by;
    }

    /**
     * Determine whether the user can delete the news.
     *
     * @param  \App\Models\Users\User  $user
     * @param  \App\News  $news
     * @return mixed
     */
    public function delete(User $user, News $news) {
        //
    }
}
