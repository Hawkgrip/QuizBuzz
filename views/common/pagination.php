<?php
// Function to render pagination controls
function renderPagination($totalRecords, $currentPage = 1, $limit = 10, $baseUrl = '') {
    $totalPages = ceil($totalRecords / $limit);
    if ($totalPages <= 1) {
        return ''; // No need to show pagination if only one page
    }

    $html = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';

    // Previous button
    $prevClass = $currentPage <= 1 ? ' disabled' : '';
    $prevPage = max($currentPage - 1, 1);
    $html .= "<li class='page-item$prevClass'><a class='page-link' href='{$baseUrl}?page={$prevPage}' aria-label='Previous'>&laquo;</a></li>";

    // Page numbers
    for ($i = 1; $i <= $totalPages; $i++) {
        $activeClass = ($i == $currentPage) ? ' active' : '';
        $html .= "<li class='page-item$activeClass'><a class='page-link' href='{$baseUrl}?page={$i}'>$i</a></li>";
    }

    // Next button
    $nextClass = $currentPage >= $totalPages ? ' disabled' : '';
    $nextPage = min($currentPage + 1, $totalPages);
    $html .= "<li class='page-item$nextClass'><a class='page-link' href='{$baseUrl}?page={$nextPage}' aria-label='Next'>&raquo;</a></li>";

    $html .= '</ul></nav>';

    return $html;
}
?>
