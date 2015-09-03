<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$translate = 'LLL:EXT:ecom_config_code_generator/Resources/Private/Language/locallang_db.xlf:';

return [
	'ctrl' => [
		'adminOnly' => TRUE,
		'title'	=> "{$translate}tx_ecomconfigcodegenerator_domain_model_dependentnote",
		'label' => 'note',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => [
			'disabled' => 'hidden'
		],
		'searchFields' => 'note,use_logical_and,dependent_parts',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('sys_note') . 'ext_icon.gif'
	],
	'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, note, use_logical_and, dependent_parts'
	],
	'types' => [
		'1' => [ 'showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, note;;2;wizards[t3editorHtml]' ]
	],
	'palettes' => [
		'1' => [ 'showitem' => '' ],
		'2' => [ 'showitem' => 'dependent_parts, --linebreak--, use_logical_and, partgroup', 'canNotCollapse' => TRUE ]
	],
	'columns' => [

		'sys_language_uid' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => [
					[ 'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1 ],
					[ 'LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0 ]
				]
			]
		],
		'l10n_parent' => [
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => [
				'type' => 'select',
				'items' => [
					[ '', 0 ]
				],
				'foreign_table' => 'tx_ecomconfigcodegenerator_domain_model_dependentnote',
				'foreign_table_where' => 'AND tx_ecomconfigcodegenerator_domain_model_dependentnote.pid=###CURRENT_PID### AND tx_ecomconfigcodegenerator_domain_model_dependentnote.sys_language_uid IN (-1,0)',
			]
		],
		'l10n_diffsource' => [
			'config' => [
				'type' => 'passthrough',
			]
		],

		't3ver_label' => [
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			]
		],

		'hidden' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => [
				'type' => 'check',
			]
		],

		'note' => [
			'exclude' => 0,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_dependentnote.note",
			'config' => [
				'type' => 'text',
				'cols' => 100,
				'rows' => 10,
				'eval' => 'trim,required',
				'wizards' => [
					't3editorHtml' => [
						'enableByTypeConfig' => 1,
						'type' => 'userFunc',
						'userFunc' => 'TYPO3\\CMS\\T3editor\\FormWizard->main',
						'params' => [
							'format' => 'html'
						]
					]
				]
			]
		],
		'use_logical_and' => [
			'exclude' => 1,
			'label' => '',
			'config' => [
				'type' => 'check',
				'items' => [
					[ "{$translate}tx_ecomconfigcodegenerator_domain_model_dependentnote.use_logical_and" ]
				]
			]
		],
		'dependent_parts' => [
			'exclude' => 1,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_dependentnote.dependent_parts",
			'config' => [
				'type' => 'select',
				'foreign_table' => 'tx_ecomconfigcodegenerator_domain_model_part',
				'foreign_table_where' => ' AND tx_ecomconfigcodegenerator_domain_model_part.pid=###REC_FIELD_pid### AND NOT tx_ecomconfigcodegenerator_domain_model_part.deleted AND tx_ecomconfigcodegenerator_domain_model_part.sys_language_uid IN (-1,0) ORDER BY tx_ecomconfigcodegenerator_domain_model_part.partgroup, tx_ecomconfigcodegenerator_domain_model_part.title',
				'MM' => 'tx_ecomconfigcodegenerator_dependentnote_part_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'minitems' => 1,
				'maxitems' => 9999,
				'multiple' => 0,
				'renderMode' => 'checkbox',
				'disableNoMatchingValueElement' => 1
			]
		],

		'partgroup' => [
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_partgroup",
			'config' => [
				'type' => 'select',
				'readOnly' => 1,
				'foreign_table' => 'tx_ecomconfigcodegenerator_domain_model_partgroup'
			]
		]
	]
];
