<?php
xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);

// for ($i = 0; $i <= 1000; $i++) {
//     $a = $i * $i;
// }

$n = 5;

echo jc($n);
echo '<br>';

echo jc2($n);
echo '<br>';

echo jc3($n);
echo '<br>';

function jc($n)
{
    if ($n == 1) {
        return 1;
    }

    return $n * jc($n-1);
}

function jc2($n)
{
    $m = 1;
    for ($i=1; $i<=$n; $i++) {
        $m = $m * $i;
    }

    return $m;
}

function jc3($n)
{
    $arr = [];
    $arr[1] = 1;

    for ($i = 2; $i<=$n; $i++) {
        $arr[$i] = $i * $arr[$i-1];
    }

    return $arr[$n];
}

$xhprof_data = xhprof_disable();
$XHPROF_ROOT = "/Users/henry/Workspace/www/xhprof";
include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_lib.php";
include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_runs.php";

$xhprof_runs = new XHProfRuns_Default();
$run_id = $xhprof_runs->save_run($xhprof_data, "xhprof_testing");

echo "http://localhost/xhprof/xhprof_html/index.php?run={$run_id}&source=xhprof_testing\n";
