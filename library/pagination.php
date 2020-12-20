<?php
class Pagination {
	public $total = 0;
	public $page = 1;
	public $limit = 20;
	public $num_links = 8;
	public $url = '';
	public $text_first = 'Первая';
	public $text_last = 'Последняя';
	public $text_next = '&#187;';
	public $text_prev = '&#171';


    public function render()
    {
      if( $this->total <= $this->limit )
        return '';

		$total = $this->total;

		if ($this->page < 1) {
			$page = 1;
		} else {
			$page = $this->page;
		}

		if (!(int)$this->limit) {
			$limit = 10;
		} else {
			$limit = $this->limit;
		}

		$num_links = $this->num_links;
		$num_pages = ceil($total / $limit);

		$this->url = str_replace('%7Bpage%7D', '{page}', $this->url);

		
		$output = '<div class="pages-nav"><div class="container container-flex">';
		

		if ($page > 1) {
			$output .= '<a href="' . str_replace('{page}', 1, $this->url) . '" class="pages-nav__links">' . $this->text_first . '</a>';
			$output .= '<a href="' . str_replace('{page}', $page - 1, $this->url) . '" class="pages-nav__links">' . $this->text_prev . '</a>';
 

        }

		if ($num_pages > 1) {
			if ($num_pages <= $num_links) {
				$start = 1;
				$end = $num_pages;
			} else {
				$start = $page - floor($num_links / 2);
				$end = $page + floor($num_links / 2);

				if ($start < 1) {
					$end += abs($start) + 1;
					$start = 1;
				}

				if ($end > $num_pages) {
					$start -= ($end - $num_pages);
					$end = $num_pages;
				}
			}

			for ($i = $start; $i <= $end; $i++) {
				if ($page == $i) {
					$output .= '<span class="pages-nav__links current" style="">' . $i . '</span>';
				} else {
					$output .= '<a href="' . str_replace('{page}', $i, $this->url) . '" class="pages-nav__links">' . $i . '</a>';
				}
			}
		}

		if ($page < $num_pages) {
			$output .= '<a href="' . str_replace('{page}', $page + 1, $this->url) . '" class="pages-nav__links">' . $this->text_next . '</a>';
			$output .= '<a href="' . str_replace('{page}', $num_pages, $this->url) . '" class="pages-nav__links">' . $this->text_last . '</a>';
		}

		$output .= '</div> </div>';
		
		

		if ($num_pages > 1) {
			return $output;
		} else {
			return '';
		}
	}
}