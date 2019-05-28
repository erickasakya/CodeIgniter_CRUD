<?php

create table tbl_client_loan(
id int(11) primary key NOT NULL AUTOINCREMENT,
loan_no varchar(45) NOT NULL,
branch_id int(11) NOT NULL,
member_id int(11) default 'NULL',
credit_officer_id int(11) NOT NULL,
group_id int(11) default 'NULL',
status_id int(2) default '1',
loan_product_id int(11),
requested_amount decimal(15,2),
application_date DATE,
disbursement_date DATE,
disbursement_notes text default 'NULL',
interest_rate decimal(5,2),
offset_period tinyint(4),
grace_period tinyint(4),
repayment_frequency tinyint(2),
repayment_made_every tinyint(4),
installments tinyint(4),
penalty_calculation_method_id tinyint(2),
penalty_tolerance_period tinyint(4),
penalty_rate_charged_per tinyint(1),
penalty_rate decimal(4,2),
link_to_deposit_account tinyint(1),
comment text,
amount_approved decimal(15,2),
approval_date date,
approved_by int(11),
approval_note text,
created_by int(11),
date_created int(11),
modified_by int(11),
date_modified timestamp


)
?>