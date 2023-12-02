<?php

foreach (glob("day??.php") as $file) {
    include($file);
}
