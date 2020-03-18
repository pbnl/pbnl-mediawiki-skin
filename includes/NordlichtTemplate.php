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

        $html .= Html::rawElement( 'div', ["class" => "container"],
            Html::rawElement( 'div', ["class" => "content"] ,$containerData));


        $html .= Html::closeElement( 'body' );
        $html .= Html::closeElement( 'html' );

        // The unholy echo
        echo $html;
    }

    private function getHeader()
    {
        $html = Html::rawElement("div", ["class" => "head"], "Test");
        return $html;
    }

    private function getLeftSidebar()
    {
        $sidebar = "";
        foreach ( $this->getSidebar() as $boxName => $box ) {
            $sidebar .= Html::rawElement("div", ["id" => Sanitizer::escapeId( $box['id'])]);
            $sidebar .= Html::rawElement("h5", [], htmlspecialchars( $box['header'] ));
        }
        $items = "";
        foreach ( $box['content'] as $key => $item ) {
            $items .= $this->makeListItem( $key, $item );
        }
        if ( is_array( $box['content'] ) ) {
            $sidebar .= Html::rawElement("ul", [], $items);
        } else {
            $sidebar .= $box['content'];
        }
        return Html::rawElement("div", ["class"=>"col-2 sidebar"], $sidebar);
    }

    private function getContent()
    {
        return Html::rawElement("div", ["class"=>"col main"], "Cont");
    }

    private function getRightSidebar()
    {
        return Html::rawElement("div", ["class"=>"col-2"], "Right");
    }

    protected function getMyFooter()
    {
        return "";
    }
}
