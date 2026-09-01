<?php
/**
 * Google / schema.org structured data (JSON-LD).
 *
 * Site-wide nodes come from FrontendController; pages add their own with
 * $this->addSchema(...). The WebPage node is built here so it always reflects
 * the final $title, unless a controller already supplied its own page node.
 *
 * @var array<int, array<string, mixed>> $schema
 */
$graph = $schema ?? [];

if ($graph !== []) {
    $pageTypes = ['WebPage', 'ItemPage', 'CollectionPage', 'AboutPage', 'ContactPage', 'Article', 'BlogPosting', 'Product'];

    $hasPageNode = false;

    foreach ($graph as $node) {
        if (in_array($node['@type'] ?? '', $pageTypes, true)) {
            $hasPageNode = true;
            break;
        }
    }

    if (! $hasPageNode) {
        $page = [
            '@type'      => 'WebPage',
            '@id'        => ($canonicalUrl ?? current_url()) . '#webpage',
            'url'        => $canonicalUrl ?? current_url(),
            'name'       => ($title ?? '') !== '' ? $title : ($siteName ?? ''),
            'isPartOf'   => ['@id' => base_url('#website')],
            'inLanguage' => 'en',
        ];

        $graph[] = $page;
    }
}
?>
<?php if ($graph !== []): ?>
<script type="application/ld+json"><?= json_encode(
    ['@context' => 'https://schema.org', '@graph' => array_values($graph)],
    JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
) ?></script>
<?php endif ?>
