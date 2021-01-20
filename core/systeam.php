<?php

	function validStr($str, $min, $max) {
		return mb_strlen($str) > $min && mb_strlen($str) < $max;
	}