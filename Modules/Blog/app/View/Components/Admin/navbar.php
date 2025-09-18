<?php

namespace Modules\Blog\View\Components\Admin;

use Illuminate\View\Component;
use Illuminate\View\View;

class navbar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct() {}

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('blog::components.admin.navbar');
    }
}
