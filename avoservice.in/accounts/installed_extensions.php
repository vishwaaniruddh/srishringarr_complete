<?php

/* List of installed additional extensions. If extensions are added to the list manually
	make sure they have unique and so far never used extension_ids as a keys,
	and $next_extension_id is also updated. More about format of this file yo will find in 
	FA extension system documentation.
*/

$next_extension_id = 27; // unique id for next installed extension

$installed_extensions = array (
  2 => 
  array (
    'name' => 'Inventory Items CSV Import',
    'package' => 'import_items',
    'version' => '2.3.0-1',
    'type' => 'extension',
    'active' => true,
    'path' => 'modules/import_items',
  ),
  3 => 
  array (
    'name' => 'Asset register',
    'package' => 'asset_register',
    'version' => '2.3.3-9',
    'type' => 'extension',
    'active' => true,
    'path' => 'modules/asset_register',
  ),
  4 => 
  array (
    'name' => 'Company Dashboard',
    'package' => 'dashboard',
    'version' => '2.3.15-5',
    'type' => 'extension',
    'active' => true,
    'path' => 'modules/dashboard',
  ),
  5 => 
  array (
    'name' => 'Import Multiple Journal Entries',
    'package' => 'import_multijournalentries',
    'version' => '2.3.0-4',
    'type' => 'extension',
    'active' => true,
    'path' => 'modules/import_multijournalentries',
  ),
  6 => 
  array (
    'name' => 'osCommerce Order and Customer Import Module',
    'package' => 'osc_orders',
    'version' => '2.3.0-2',
    'type' => 'extension',
    'active' => true,
    'path' => 'modules/osc_orders',
  ),
  7 => 
  array (
    'name' => 'Annual balance breakdown report',
    'package' => 'rep_annual_balance_breakdown',
    'version' => '2.3.0-1',
    'type' => 'extension',
    'active' => true,
    'path' => 'modules/rep_annual_balance_breakdown',
  ),
  8 => 
  array (
    'name' => 'Annual expense breakdown report',
    'package' => 'rep_annual_expense_breakdown',
    'version' => '2.3.0-1',
    'type' => 'extension',
    'active' => true,
    'path' => 'modules/rep_annual_expense_breakdown',
  ),
  9 => 
  array (
    'name' => 'Cash Flow Statement Report',
    'package' => 'rep_cash_flow_statement',
    'version' => '2.3.0-1',
    'type' => 'extension',
    'active' => true,
    'path' => 'modules/rep_cash_flow_statement',
  ),
  10 => 
  array (
    'name' => 'Check Printing based on Tom Hallman, USA',
    'package' => 'rep_check_print',
    'version' => '2.3.0-1',
    'type' => 'extension',
    'active' => true,
    'path' => 'modules/rep_check_print',
  ),
  11 => 
  array (
    'name' => 'Dated Stock Sheet',
    'package' => 'rep_dated_stock',
    'version' => '2.3.3-2',
    'type' => 'extension',
    'active' => true,
    'path' => 'modules/rep_dated_stock',
  ),
  12 => 
  array (
    'name' => 'Inventory History',
    'package' => 'rep_inventory_history',
    'version' => '2.3.2-1',
    'type' => 'extension',
    'active' => true,
    'path' => 'modules/rep_inventory_history',
  ),
  13 => 
  array (
    'name' => 'Sales Summary Report',
    'package' => 'rep_sales_summary',
    'version' => '2.3.3-2',
    'type' => 'extension',
    'active' => true,
    'path' => 'modules/rep_sales_summary',
  ),
  14 => 
  array (
    'name' => 'Bank Statement w/ Reconcile',
    'package' => 'rep_statement_reconcile',
    'version' => '2.3.3-2',
    'type' => 'extension',
    'active' => true,
    'path' => 'modules/rep_statement_reconcile',
  ),
  15 => 
  array (
    'name' => 'Tax inquiry and detailed report on cash basis',
    'package' => 'rep_tax_cash_basis',
    'version' => '2.3.7-3',
    'type' => 'extension',
    'active' => true,
    'path' => 'modules/rep_tax_cash_basis',
  ),
  16 => 
  array (
    'name' => 'Report Generator',
    'package' => 'repgen',
    'version' => '2.3.9-3',
    'type' => 'extension',
    'active' => true,
    'path' => 'modules/repgen',
  ),
  17 => 
  array (
    'name' => 'Requisitions',
    'package' => 'requisitions',
    'version' => '2.3.13-2',
    'type' => 'extension',
    'active' => true,
    'path' => 'modules/requisitions',
  ),
  19 => 
  array (
    'name' => 'zen_import',
    'package' => 'zen_import',
    'version' => '2.3.15-1',
    'type' => 'extension',
    'active' => true,
    'path' => 'modules/zen_import',
  ),
  20 => 
  array (
    'name' => 'Check Printing based on Tu Nguyen, Canada',
    'package' => 'rep_cheque_print',
    'version' => '2.3.0-1',
    'type' => 'extension',
    'active' => true,
    'path' => 'modules/rep_cheque_print',
  ),
  21 => 
  array (
    'name' => 'Import Paypal transactions',
    'package' => 'import_paypal',
    'version' => '2.3.10-2',
    'type' => 'extension',
    'active' => true,
    'path' => 'modules/import_paypal',
  ),
  22 => 
  array (
    'name' => 'Theme Dashboard',
    'package' => 'dashboard_theme',
    'version' => '2.3.15-3',
    'type' => 'theme',
    'active' => true,
    'path' => 'themes/dashboard',
  ),
  23 => 
  array (
    'name' => 'Theme Exclusive for Dashboard',
    'package' => 'exclusive_db',
    'version' => '2.3.10-3',
    'type' => 'theme',
    'active' => true,
    'path' => 'themes/exclusive_db',
  ),
  24 => 
  array (
    'name' => 'Theme Modern',
    'package' => 'modern',
    'version' => '2.3.0-5',
    'type' => 'theme',
    'active' => true,
    'path' => 'themes/modern',
  ),
  25 => 
  array (
    'name' => 'Theme Anterp',
    'package' => 'anterp',
    'version' => '2.3.0-4',
    'type' => 'theme',
    'active' => true,
    'path' => 'themes/anterp',
  ),
  26 => 
  array (
    'name' => 'English Indian COA - New.',
    'package' => 'chart_en_IN-general',
    'version' => '2.3.0-4',
    'type' => 'chart',
    'active' => true,
    'path' => 'sql',
    'sql' => 'en_IN-new.sql',
  ),
);
?>