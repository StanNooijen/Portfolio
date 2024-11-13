<?php
// app/View/Components/Projecten.php
namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Projecten extends Component
{
    public $title;
    public $description;
    public $image;
    public $languages;

    public function __construct($title, $description, $image, $languages)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->languages = $languages;
    }

    public function render(): View|Closure|string
    {
        return view('components.projecten');
    }
}
