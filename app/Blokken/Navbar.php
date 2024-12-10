<?php

namespace App\Blokken;

use App\Models\Contact;
use App\Models\navbar_items;

class Navbar
{

    public function right_side($navbar_id){
        $navItems = navbar_items::where('navbar_id', $navbar_id)->get();
        $socials = contact::all()->first();

        $socialButton = '';

        $navlinks = '';

        if ($navItems) {
            foreach ($navItems as $navItem) {
                $navlinks .= '<a class="nav-button" href="'. $navItem->ref .'">'. $navItem->label .'</a>';
            }
        }

        if ($socials) {
            $socials->social_media = explode(',', $socials->social_media);
            $socials->social_links = explode(',', $socials->social_links);

            for ($i = 0; $i < count($socials->social_media); $i++) {
                $socialButton .= '
                <div class="nav-socials">
                    <a href="' . $socials->social_media[$i] . '">' . $socials->social_media[$i] . '
                    <div class="blokje">
                        <img src="' . asset('images/socials/' . $socials->social_media[$i] . '.png') . '" alt="' . $socials->social_media[$i] . '">
                    </div>
                    </a>
                </div>';
            }
        }

        $html = '
            <div class="navigator">
                <div class="hamburger" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="navigation">
                <div class="nav-links">
                    <div class="links">
                        '.$navlinks.'
                    </div>
                    <div class="links">
                        <h2>Socials</h2>
                        '.$socialButton.'
                    </div>
                    <div class="links">
                        <h2>Talen</h2>
                        <a class="nav-button" href="#">NLD<img src="'. asset('images/netherlands.png') .'" alt="NL"></a>
                        <a class="nav-button" href="#">ENG<img src="'. asset('images/united-kingdom.png') .'" alt="UK"></a>
                    </div>
                </div>
            </div>
            ';
        return $html;
    }
}
