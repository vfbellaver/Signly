<?php
$html = '<bookmark content="Start of the Document" /><div>Section 1 text</div>';

$mpdf->WriteHTML($html);
$mpdf->Output();
