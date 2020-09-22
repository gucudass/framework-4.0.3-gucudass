
<div class="modal-backdrop" id="modelCommSpinner" data-backdrop="static" data-keyboard="false" style="display: none;z-index: 9999 !important;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex align-items-center">
                    <strong>처리중...</strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="/js/base.js"></script>

<?php

if (empty($aExternalJs) === false) {
    foreach ($aExternalJs as $jsPath) {
        if (empty($jsPath)) continue;
        echo '<script src="' . $jsPath . '"></script>' . PHP_EOL;
    }
}

if (empty($aWriteJs) === false) {
    echo '<script>' . PHP_EOL;
    foreach ($aWriteJs as $sJs) {
        if (empty($sJs)) continue;
        echo $sJs . PHP_EOL;
    }
    echo '</script>' . PHP_EOL;
}

if (empty($aJs) === false) {
    foreach ($aJs as $jsPath) {
        if (empty($jsPath)) continue;
        echo '<script src="/js/' . $jsPath . '.js"></script>' . PHP_EOL;
    }
}

?>

</body>
</html>
