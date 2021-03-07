<?php
$comment = connectDB()->bindQuery("SELECT * FROM comment");
foreach ($comment as $key => $value) {
	echo base64_decode($value->status);
}