<?php

namespace App\Http\Controllers\Admin\Livewire\Admins;

use App\Repository\Cours\CoursInterface;
use Livewire\Component;

class ShowPosts extends Component
{
    protected $cours;

    /**
     * CoursController constructor.
     * @param $cours
     */
    public function __construct(
        CoursInterface $cours

    ) {
        $this->cours = $cours;
    }

    public function render()
    {
        $cours =  $this->cours->all_cours();
        return view('Admin.livewire.Admins.show-posts', [
            'cours' => $cours
        ]);
    }
}
