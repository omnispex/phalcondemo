<?php
use Phalcon\Mvc\Controller,
    Phalcon\Tag,
    Phalcon\Mvc\Dispatcher,
    Phalcon\Escaper,
    Phalcon\Http\Response,
    Phalcon\Assets\Filters\Cssmin,
    Phalcon\Assets\Filters\Jsmin;

class ControllerBase extends Controller
{
    /**
     * Retrieve general data necessary for all pages
     * @Source(key="initialize",lifetime=86400)
     * @return view
     */
    protected function initialize()
    {
        Tag::setTitle('Articles');
        $escaper = new Escaper();
        $escaper->setEncoding('utf-8');
        $escaper->setHtmlQuoteType(ENT_XHTML);
        $escaper->escapeHtmlAttr("<script>");
        $escaper->escapeHtmlAttr("</script>");
        $this->response->setHeader('Cache-Control', 'max-age=86400');

    }

    /**
     * Retrieve languagekey
     * @Source(key="languagekey",lifetime=86400)
     * @return string
     */
    protected function languagekey()
    {
        $languagekey='en';
        return $languagekey;
    }
}