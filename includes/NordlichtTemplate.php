<?php
/**
 * BaseTemplate class for the Timeless skin
 *
 * @ingroup Skins
 */
class NordlichtTemplate extends BaseTemplate {

    /**
     * Outputs the entire contents of the page
     */
    public function execute() {
        $this->sidebar = $this->getSidebar();


        // Open html, body elements, etc
        $html = $this->get( 'headelement' );
        $containerData = $this->getHeader().
            Html::rawElement("div", ["class" => "row"],
                $this->getLeftSidebar().
                $this->getContent().
                $this->getRightSidebar()).
            $this->getMyFooter();

        $html .= Html::rawElement( 'div', ["class" => "container-lg"],
            Html::rawElement( 'div', ["class" => "content"] ,$containerData));


        $html .= Html::closeElement( 'body' );
        $html .= Html::closeElement( 'html' );

        // The unholy echo
        echo $html;
    }

    private function getHeader()
    {
        $head = "";
        if ($this->data['loggedin']) {
            $list = "";
            foreach ($this->data['content_actions'] as $key => $tab) {
                $list .= $this->makeListItem( $key, $tab );

            }
            $head .= Html::rawElement("ul", [], $list);
        }
        $html = Html::rawElement("div", ["class" => "row"],
            Html::rawElement("div", ["class" => "col"],
                Html::rawElement("div", ["class" => "head"], $head)
            )
        );
        return $html;
    }

    private function getLeftSidebar()
    {
        $sidebar = "";
        foreach ( $this->getSidebar() as $boxName => $box ) {
            $sidebar .= Html::rawElement("div", ["id" => Sanitizer::escapeId( $box['id'])]);
            $sidebar .= Html::rawElement("h5", [], htmlspecialchars( $box['header'] ));
            if ( is_array( $box['content'] ) ) {
                $items = "";
                foreach ( $box['content'] as $key => $item ) {
                    $items .= $this->makeListItem( $key, $item );
                }
                $sidebar .= Html::rawElement("ul", [], $items);
            } else {
                $sidebar .= $box['content'];
            }
        }
        return Html::rawElement("div", ["class"=>"col-2 sidebar"], $sidebar);
    }

    private function getContent()
    {
        $content = "";
        $content .= $this->get('sitenotice');
        $content .= Html::rawElement("h1", ["class" => "firstHeadding"],
        $this->data['displaytitle']!="" ? $this->get('title') : $this->get('title'));
        Html::rawElement("div", ["id"=>"contentSub"], $this->get('subtitle'));

        if($this->data['undelete']) { $content .= Html::rawElement("div",  ["id"=>"contentSub2"], $this->get('undelete'));}
        if($this->data['newtalk']) { $content .= Html::rawElement("div",  ["class"=>"usermessage"], $this->get('newtalk'));}

        $content .= $this->get('bodytext');
        $content .= $this->get('catlinks');
        return Html::rawElement("div", ["class"=>"col main"], $content);
    }

    private function getRightSidebar()
    {
        $titel = Html::rawElement("h5", [],
            Html::rawElement("label", ["for"=>"searchInput"],  "Suche")
        );
        $form = Html::rawElement("form", ["action" => $this->get( 'wgScript' ), "id"=>"searchform"],
                Html::rawElement("input", ["type"=>"hidden", "value" => $this->get( 'searchtitle' )]).
                $this->makeSearchInput().
                $this->makeSearchButton( 'go' ).
                $this->makeSearchButton( 'fulltext' )
                );

        $personalLinks = "";
        foreach($this->getPersonalTools() as $key => $item) {
            $personalLinks .= $this->makeListItem( $key, $item );
        }

        $personalTools = Html::rawElement("h5", [], "Nordlichter");
        $personalTools .= Html::rawElement("ul", [], $personalLinks);

        $sidebar = $titel.$form.$personalTools;
        return Html::rawElement("div", ["class"=>"col-2 sidebar right"], $sidebar);
    }

    protected function getMyFooter()
    {
        $list = "";
        $footerlinks = array('lastmod', 'viewcount');
        foreach( $footerlinks as $aLink ) {
            if( isset( $this->data[$aLink] ) && $this->data[$aLink] ) {
                $list .= Html::rawElement("li", [], $this->get($aLink));
            }
        }
        $html = Html::rawElement("div", ["class" => "row"],
            Html::rawElement("div", ["class" => "col"],
                Html::rawElement("div", ["class" => "foot"],
                    Html::rawElement("ul", [], $list))
            )
        );
        return $html;
    }
}
