<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $news = [
        1 => [
            'title' => 'News Title 1',
            'content' => 'News 1 Content News 1 Content News 1 Content News 1 Content.',
        ],
        2 => [
            'title' => 'News Title 2',
            'content' => 'News 2 Content News 1 Content News 1 Content News 1 Content.',
        ],
        3 => [
            'title' => 'News Title 3',
            'content' => 'News 3 Content News 1 Content News 1 Content News 1 Content.',
        ],
        4 => [
            'title' => 'News Title 4',
            'content' => 'News 4 Content News 1 Content News 1 Content News 1 Content.',
        ],
    ];

    public function index()
    {
        return view('news', [
            'title' => 'News Headlines',
            'newslist' => $this->news,
        ]);

    }

    public function read($id, $print = 'NO-PRINT')
    {
        return view('news-details', [
            'news' => $this->news[$id],
        ]);
    }
}
