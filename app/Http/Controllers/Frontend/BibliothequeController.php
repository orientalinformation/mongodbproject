<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Helpers\Envato\Ulities;
use Elasticsearch\ClientBuilder;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Bibliotheque\BibliothequeRepositoryInterface;

class BibliothequeController extends Controller
{
    /**
     * @var BibliothequeRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $bibliothequetRepository;

	/**
     * Instantiate product controller.
     *
     * @param Request $request
     * @param BibliothequeRepositoryInterface $bibliothequeRepository
     * @return void
     */
    public function __construct(
        Request $request,
        BibliothequeRepositoryInterface $bibliothequeRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->request = $request;
        $this->bibliothequeRepository = $bibliothequeRepository;
    }

    /** 
     * Display Bibliottheque
     * @return View
     */
    public function index()
    {
        return view('Frontend.Bibliotheque.index');
    }
}
