<?php
namespace App;
use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Basic;
class ContentPolicy extends Basic
{
public function configure()
{
parent::configure();

$this->addDirective(Directive::DEFAULT, '172.30.100.207');
$this->addDirective(Directive::DEFAULT, 'https://fonts.googleapis.com/css?family=Cardo:400,300,100,500,700,900');
$this->addDirective(Directive::DEFAULT, 'https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap');
$this->addDirective(Directive::DEFAULT, 'https://code.jquery.com/ui/1.12.1/*');
$this->addDirective(Directive::DEFAULT, 'https://cdn.ckeditor.com/*');
$this->addDirective(Directive::FRAME_ANCESTORS, "'none'");
}
}
