<?php


/**
 * Class containing static properties being reusable HTML components as strings.
 */
class HTMLComponents
{
	/**
	 * @param array<string, string> $dirs Array of [pageName => href] pairs.
	 * @return string HTML Navbar
	 */
    public static function NavBar(array $dirs = []): string {
		$html = <<<HTML
		<nav aria-label="Main Navigation" class="main-navbar">
		HTML;
		$isAssociative = !array_is_list($dirs);
		
		foreach (array_keys($dirs) as $dirKey) {
			$pageName = $isAssociative
				? $dirKey
				: $dirs[$dirKey]; // $dirKey is an inex is the array is a list.
			$href = ($isAssociative
				? (!empty($dirs[$dirKey]) ? $dirs[$dirKey] : '#') // If href is an empty: (null, '', [], etc.), then '#'
				: '#');
				
			
			$html .= <<<HTML
				<a href="$href">$pageName</a>
			HTML;
			
		}
		
		$html .= "</nav>";
		return $html;
	}
}