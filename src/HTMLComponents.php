<?php


/**
 * Class containing static properties being reusable HTML components as strings.
 */
class HTMLComponents
{
    public static function NavBar(): string {
		
		
		
		return
		<<<HTML
		<nav aria-label="Main Navigation" class="main-navbar">
		    <a href="#">Home</a>
		    <a href="#">Test1</a>
		    <a href="#">Test2</a>
		    <a href="#">Test3</a>
		</nav>
		HTML;
	}
}