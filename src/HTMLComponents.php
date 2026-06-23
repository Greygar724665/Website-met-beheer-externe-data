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
			$href = $currPage
				? '#'
				: $href;
			$currAria = $currPage
				? 'aria-current="page"'
 				: ''
            ;

			$html .= <<<HTML
				<a $currAria href="$href">$pageName</a>
			HTML;
			
		}
		if ($addSearchbar)
			$html .= self::SearchBar("margin-left: auto !important;", id: 'nav-searchbar');
		$html .= "</nav>";
		return $html;
	}
	
	/**
	 * @param string|null $styling Extra styling to be defined the HTML inline CSS style attribute.
	 * @param string|null $id  HTML `id` attribute
	 * @param string|null $placeholderText HTML placeholder attribute of `<input>`
	 * @param string $ariaLabel A description for assistive page content readers
	 * @param bool $inputFirst Whether the search-icon should come first
	 * @return string HTML Searchbar
	 */
	public static function SearchBar(?string $styling = null, ?string $id = "searchbar", ?string $placeholderText = "Search...", string $ariaLabel = "Searchbar", bool $inputFirst = true): string {
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
		$id = trim($id) !== ''
			? htmlspecialchars($id)
			: "searchbar"
		;
		$magniGlass = SVGElements::MagnifyingGlass('#757575', width: 14, height: 14);
		$span = <<<HTML
			<span aria-hidden="true">$magniGlass</span>
		HTML;
		$input = <<< HTML
			<input type="search" aria-label="$ariaLabel" type="text" id="$id" name="search" placeholder="$placeholderText">
		HTML;
		
		$top = $inputFirst
			? $input
			: $span
		;
		$bottom = $inputFirst
			? $span
			: $input
		;
		
		return <<<HTML
		<div $styling class="cst-input-group">
			$top
			$bottom
		</div>
		HTML;
	}
	
}