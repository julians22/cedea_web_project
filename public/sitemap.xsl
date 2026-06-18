<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xhtml="http://www.w3.org/1999/xhtml">
    <xsl:output method="html" encoding="UTF-8" indent="yes" />

    <xsl:template match="/">
        <html lang="en">
            <head>
                <meta charset="UTF-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>CEDEA Sitemap</title>
                <style>
                    body {
                        margin: 0;
                        background: #f8fafc;
                        color: #1f2937;
                        font-family: Arial, sans-serif;
                        line-height: 1.5;
                    }

                    main {
                        margin: 0 auto;
                        max-width: 1200px;
                        padding: 32px 20px;
                    }

                    h1 {
                        margin: 0 0 8px;
                        color: #b91c1c;
                        font-size: 28px;
                    }

                    p {
                        margin: 0 0 24px;
                        color: #64748b;
                    }

                    table {
                        width: 100%;
                        border-collapse: collapse;
                        overflow: hidden;
                        border-radius: 12px;
                        background: #ffffff;
                        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
                    }

                    th,
                    td {
                        border-bottom: 1px solid #e5e7eb;
                        padding: 12px 14px;
                        text-align: left;
                        vertical-align: top;
                    }

                    th {
                        background: #b91c1c;
                        color: #ffffff;
                        font-size: 13px;
                        letter-spacing: 0.04em;
                        text-transform: uppercase;
                    }

                    tr:last-child td {
                        border-bottom: 0;
                    }

                    a {
                        color: #b91c1c;
                        overflow-wrap: anywhere;
                    }

                    .muted {
                        color: #64748b;
                    }
                </style>
            </head>
            <body>
                <main>
                    <xsl:choose>
                        <xsl:when test="sitemap:sitemapindex">
                            <h1>Sitemap Index</h1>
                            <p>
                                This index contains
                                <xsl:value-of select="count(sitemap:sitemapindex/sitemap:sitemap)" />
                                sitemap files.
                            </p>
                            <table>
                                <thead>
                                    <tr>
                                        <th>URL</th>
                                        <th>Last Modified</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <xsl:for-each select="sitemap:sitemapindex/sitemap:sitemap">
                                        <tr>
                                            <td>
                                                <a href="{sitemap:loc}">
                                                    <xsl:value-of select="sitemap:loc" />
                                                </a>
                                            </td>
                                            <td class="muted">
                                                <xsl:value-of select="sitemap:lastmod" />
                                            </td>
                                        </tr>
                                    </xsl:for-each>
                                </tbody>
                            </table>
                        </xsl:when>
                        <xsl:otherwise>
                            <h1>URL Sitemap</h1>
                            <p>
                                This sitemap contains
                                <xsl:value-of select="count(sitemap:urlset/sitemap:url)" />
                                URLs.
                            </p>
                            <table>
                                <thead>
                                    <tr>
                                        <th>URL</th>
                                        <th>Last Modified</th>
                                        <th>Frequency</th>
                                        <th>Priority</th>
                                        <th>Alternates</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <xsl:for-each select="sitemap:urlset/sitemap:url">
                                        <tr>
                                            <td>
                                                <a href="{sitemap:loc}">
                                                    <xsl:value-of select="sitemap:loc" />
                                                </a>
                                            </td>
                                            <td class="muted">
                                                <xsl:value-of select="sitemap:lastmod" />
                                            </td>
                                            <td class="muted">
                                                <xsl:value-of select="sitemap:changefreq" />
                                            </td>
                                            <td class="muted">
                                                <xsl:value-of select="sitemap:priority" />
                                            </td>
                                            <td class="muted">
                                                <xsl:value-of select="count(xhtml:link)" />
                                            </td>
                                        </tr>
                                    </xsl:for-each>
                                </tbody>
                            </table>
                        </xsl:otherwise>
                    </xsl:choose>
                </main>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
