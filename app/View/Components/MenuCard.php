<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MenuCard extends Component
{

    public $judul;
    public $deskripsi;
    public $icon;
    public $to;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($judul = 'JUDUL', $deskripsi = 'DESKRIPSI', $icon = 'wc', $to ='#')
    {
        $this->judul     = $judul;
        $this->deskripsi = $deskripsi;
        $this->icon      = $icon;
        $this->to        = $to;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu-card');
    }
}
