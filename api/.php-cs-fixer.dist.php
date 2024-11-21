<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
;

return (new PhpCsFixer\Config())
    ->setRules([
       '@PER-CS' => true,
       '@PHP83Migration' => true,
       'nullable_type_declaration_for_default_null_value' => true,
       'array_syntax' => ['syntax' => 'short'],
       'binary_operator_spaces' => true,
       'blank_line_after_opening_tag' => true,
       'cast_spaces' => ['space' => 'single'],
       'class_attributes_separation' => [
           'elements' => ['method' => 'one'],
       ],
       'concat_space' => ['spacing' => 'one'],
       'declare_strict_types' => true,
       'doctrine_annotation_spaces' => ['around_commas' => true],
       'fully_qualified_strict_types' => true,
       'global_namespace_import' => true,
       'linebreak_after_opening_tag' => true,
       'multiline_whitespace_before_semicolons' => true,
       'no_blank_lines_after_class_opening' => true,
       'no_blank_lines_after_phpdoc' => true,
       'no_leading_namespace_whitespace' => true,
       'no_multiline_whitespace_around_double_arrow' => true,
       'no_singleline_whitespace_before_semicolons' => true,
       'no_superfluous_phpdoc_tags' => true,
       'no_trailing_comma_in_singleline' => true,
       'no_unused_imports' => true,
       'no_whitespace_in_blank_line' => true,
       'php_unit_test_class_requires_covers' => true,
       'phpdoc_line_span' => ['property' => 'single'],
       'single_line_comment_style' => true,
       'single_quote' => true,
       'space_after_semicolon' => true,
       'trailing_comma_in_multiline' => true,
       'whitespace_after_comma_in_array' => true,
       'yoda_style' => false,
   ])
    ->setFinder($finder)
    ->setRiskyAllowed(true)
;
