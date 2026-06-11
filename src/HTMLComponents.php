<?php
require_once 'SVGElements.php';

/**
 * Class containing static properties being reusable HTML components as strings.
 */
class HTMLComponents
{
	/**
	 * @param array<string, string> $dirs Array of [pageName => href] pairs. `null -> '#'`, `__CURR -> '#' & Green name`
	 * @param string|null $styling Extra styling to be defined the HTML inline CSS style attribute.
	 * @param bool $addSearchbar Whether to add the searchbar to the navbar
	 * @return string HTML Navbar
	 */
    public static function NavBar(array $dirs = [], ?string $styling = null, string $ariaLabel = "Navigation", bool $addSearchbar = false): string {
	    $styling = trim($styling ?? '') !== ''
		    ? "style = \"".htmlspecialchars($styling)."\""
		    : "";
	    $ariaLabel = trim($ariaLabel) !== ''
		    ? htmlspecialchars($ariaLabel)
		    : "Navigation";
		$html = <<<HTML
		<nav $styling aria-label="$ariaLabel" class="main-navbar">
		HTML;
		$isAssociative = !array_is_list($dirs);
//		$placedCurrent = false;
		foreach (array_keys($dirs) as $dirKey) {
			$pageName = $isAssociative
				? $dirKey
				: $dirs[$dirKey]
			; // $dirKey is an index is the array is a list.
			$href = ($isAssociative
				? (!empty($dirs[$dirKey]) ? $dirs[$dirKey] : '#') // If href is an empty: (null, '', [], etc.), then '#'
				: '#')
			;
			
			$currPage = $href == '__CURR';
			if ($currPage) $placedCurrent = true;
			$href = $currPage
				? '#'
				: $href;
			$currAria = $currPage
				? 'aria-current="page"'
 				: ''
            ;
//			$swipeDir = $placedCurrent
//				? "next"
//				: "prev"
//			;
//
			$html .= <<<HTML
				<a $currAria href="$href">$pageName</a>
			HTML;
			
		}
		if ($addSearchbar)
			$html .= self::SearchBar("margin-left: auto !important;");
		$html .= "</nav>";
		return $html;
	}
	
	/**
	 * @param string|null $styling Extra styling to be defined the HTML inline CSS style attribute.
	 * @param string|null $placeholderText HTML placeholder attribute of `<input>`
	 * @param string $ariaLabel A description for assistive page content readers
	 * @return string HTML Searchbar
	 */
	public static function SearchBar(?string $styling = null, ?string $placeholderText = "Search...", string $ariaLabel = "Searchbar"): string {
		$styling = trim($styling ?? '') !== ''
			? "style = \"".htmlspecialchars($styling)."\""
			: ""
		;
		$ariaLabel = trim($ariaLabel) !== ''
			? htmlspecialchars($ariaLabel)
			: "Searchbar"
		;
		$placeholderText = trim($placeholderText) !== ''
			? htmlspecialchars($placeholderText)
			: "Search..."
		;
		$magniGlass = SVGElements::MagnifyingGlass('#757575', width: 14, height: 14);
		return <<<HTML
		<div $styling class="cst-input-group">
			<input aria-label="$ariaLabel" type="text" id="nav-searchbar" placeholder="$placeholderText">
			<span aria-hidden="true">$magniGlass</span>
		</div>
		HTML;
	}
	
}