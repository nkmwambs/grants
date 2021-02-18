<?php

	// S3 Configuration
	$config['upload_files_to_s3'] = true;
	$config['s3_region'] = 'eu-west-1';
	$config['s3_bucket_name'] = 'compassion-fcp-fms-version2';
	$config['temp_files_deletion_limit_hours'] = 0.5; // In hours. Use fractional of while or whole number e.g. 1, 2, 2.5

    $config['attachment_table_name'] = 'attachment';
    $config['write_db_array_connection_key'] = 'write_db';
    $config['read_db_array_connection_key'] = 'read_db';
    $config['attachment_key_column'] = 'attachment_primary_id'; 
