<?php
/**
 * Copyright (c) 2024 Fabian Wolf <wolf@ilias.de>
 * GPLv3, see LICENSE
 */

/**
 * Test Page Component GUI
 *
 * @author Fabian Wolf <wolf@ilias.de>
 *
 * @ilCtrl_isCalledBy ilCOPageSpacerPluginGUI: ilPCPluggedGUI
 * @ilCtrl_isCalledBy ilCOPageSpacerPluginGUI: ilUIPluginRouterGUI
 */
class ilCOPageSpacerPluginGUI extends ilPageComponentPluginGUI
{
    private \ILIAS\UI\Factory $factory;
    private \ILIAS\UI\Renderer $renderer;
    private \Psr\Http\Message\ServerRequestInterface|\Psr\Http\Message\RequestInterface $request;
    private \ILIAS\Refinery\Factory $refinery;

    protected ilCtrl $ctrl;

    protected ilGlobalTemplateInterface $tpl;

    protected array $units = [
        "%", "px", "rem", "vw", "vh", "vmin", "vmax", "pt", "cm", "mm", "in", "pc", "em", "ex", "ch"
    ];

    /**
     * ilTestPageComponentPluginGUI constructor.
     */
    public function __construct()
    {
        global $DIC;

        $this->lng = $DIC->language();
        $this->ctrl = $DIC->ctrl();
        $this->tpl = $DIC->ui()->mainTemplate();
        $this->factory = $DIC->ui()->factory();
        $this->renderer = $DIC->ui()->renderer();
        $this->request = $DIC->http()->request();
        $this->refinery = $DIC->refinery();
    }


    /**
     * Execute command
     */
    public function executeCommand() : void
    {
        $next_class = $this->ctrl->getNextClass();

        switch($next_class) {
            default:
                // perform valid commands
                $cmd = $this->ctrl->getCmd();
                if (in_array($cmd, array("create", "save", "edit", "update", "cancel", "downloadFile"))) {
                    $this->$cmd();
                }
                break;
        }
    }

    public function insert() : void
    {
        $form = $this->initForm(true);
        $this->tpl->setContent($this->renderer->render($form));
    }

    public function create() : void
    {
        $form = $this->initForm(true);
        $this->save(true, $form);
        $this->tpl->setContent($this->renderer->render($form));
    }

    public function update() : void
    {
        $form = $this->initForm(false);
        $this->save(false, $form);
        $this->tpl->setContent($this->renderer->render($form));
    }

    public function edit() : void
    {
        $form = $this->initForm(false);
        $this->tpl->setContent($this->renderer->render($form));
    }

    protected function save(bool $create, \ILIAS\UI\Component\Input\Container\Form\Standard $form) : void
    {
        $form = $form->withRequest($this->request);
        $data = $form->getData();
        $prop = $this->getProperties();

        if($data !== null) {
            $prop['size'] = $data['size'] ?? 1;
            $prop['unit'] = $data['unit'] ?? "px";

            if($create) {
                $this->createElement($prop);
            } else {
                $this->updateElement($prop);
            }

            $this->tpl->setOnScreenMessage("success", $this->plugin->txt("success"), true);
            $this->returnToParent();
        }

    }

    protected function initForm(bool $create) : \ILIAS\UI\Component\Input\Container\Form\Standard
    {
        $prop = $this->getProperties();

        $fields = [
            "size" => $this->factory->input()->field()->numeric($this->plugin->txt("size"))
                                                      ->withValue(($prop['size'] ?? 1))
                                                      ->withRequired(true)
                                                      ->withAdditionalTransformation($this->refinery->int()->isGreaterThan(0)),
            "unit" => $this->factory->input()->field()->select($this->plugin->txt("unit"), array_combine($this->units, $this->units))
                                                      ->withValue($prop['unit'] ?? 'px')
                                                      ->withRequired(true)
        ];

        return $this->factory->input()->container()->form()->standard($this->ctrl->getFormAction($this, $create ? "create" : "update"), $fields);
    }

    public function cancel()
    {
        $this->returnToParent();
    }

    public function getElementHTML($a_mode, array $a_properties, $plugin_version) : string
    {
        $size = $a_properties['size'] ?? 1;
        $unit = $a_properties['unit'] ?? "px";

        $text = $a_mode === "edit" ? $this->plugin->txt("spacer") . " " . $size . $unit: "";

        return "<dic style='height: $size$unit; display:inline-block; width: 100%'>$text</dic>";
    }
}
