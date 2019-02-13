<?php
/* @var $this yii\web\View */
$this->title = 'URL Shortener | defyma.com';
?>

<div class="hero">
    <h1 class="hero__title"><?=$this->title?></h1>
</div>

<div class="wrapper">
    <div class="installation">
        <div class="tab__container">
            <pre class="nohighlight code">
            <code class="tab__pane active mac">
                <input type="text" class="input-box" placeholder="Paste the URL to be shortened">
            </code>
            </pre>
            <button type="button" class="btn-short">Shorten URL</button>
        </div>
    </div>

    <div class="callout">
        <h3 class="section__title">Latest URL</h3>
        <?= $this->render('table_url', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ])?>
    </div>

    <div class="changelog">
        <div class="wrapper">
            <h3 class="section__title">Public API</h3>
            Base URL: https://go.defyma.com/url <br /> <br />
            <div class="changelog__item">
                <div class="changelog__meta">
                    <h4 class="changelog__title">Shorten <br /> POST</h4>
                    <small class="changelog__date"></small>
                </div>
                <div class="changelog__detail" style="width: 100%; margin-left: 50px;">
                    <table class="table-latest">
                        <thead>
                            <tr>
                                <th>Parameter</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>type</td>
                                <td>short</td>
                            </tr>
                            <tr>
                                <td>link</td>
                                <td>Any Valid Link URL</td>
                            </tr>
                        </tbody>
                    </table>

                    <strong>Example:</strong>
                    <br />
                    POST https://go.defyma.com/url?type=<span class="red">short</span>&link=<span class="red">https://defyma.com/project/8e74935286703bfbe84fb4d80a8d56f7683d0871/jabatan-fungsional</span> <br /><br />

                    <strong>Response:</strong>
                    <code><pre>
{
    "status": "success",
    "message": "success",
    "link": "https://go.defyma.com/XP"
}
                    </pre></code>
                </div>
            </div>

            <div class="changelog__item">
                <div class="changelog__meta">
                    <h4 class="changelog__title">Decrypt <br /> GET</h4>
                    <small class="changelog__date"></small>
                </div>
                <div class="changelog__detail" style="width: 100%; margin-left: 50px;">
                    <table class="table-latest">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>type</td>
                            <td>decrypt</td>
                        </tr>
                        <tr>
                            <td>hash</td>
                            <td>Any Valid Hash From Shorten URL</td>
                        </tr>
                        </tbody>
                    </table>

                    <strong>Example:</strong>
                    <br />
                    GET https://go.defyma.com/url?type=<span class="red">decrypt</span>&hash=<span class="red">XP</span> <br /><br />

                    <strong>Response:</strong>
                    <code><pre>
{
    "status": "success",
    "message": "success",
    "link": "https://defyma.com/project/8e74935286703bfbe84fb4d80a8d56f7683d0871/jabatan-fungsional"
}
                    </pre></code>

                </div>
            </div>
        </div>
    </div>
</div>
