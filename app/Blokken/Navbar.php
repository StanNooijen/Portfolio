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
                $navlinks .= '<a href="#'. $navItem->ref .'">'. $navItem->label .'</a>';
            }
        }

        if ($socials) {
            $socials->social_media = explode(',', $socials->social_media);
            $socials->social_links = explode(',', $socials->social_links);

            for ($i = 0; $i < count($socials->social_media); $i++) {
                $socialButton .= '
                <div class="nav-socials">
                    <p>'. $socials->social_media[$i] .'</p>
                    <div class="blokje">
                        <a href="'. $socials->social_links[$i] .'" target="_blank" class="social-icon">
                            <img src="'. asset('images/socials/' . $socials->social_media[$i] . '.png') .'" alt="'. $socials->social_media[$i] .'">
                        </a>
                    </div>
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
                        '.$socialButton.'
                    </div>
                </div>
            </div>
            ';
        return $html;
    }
}
