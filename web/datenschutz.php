<?php require 'vendor/autoload.php';
//\smnbots\Auth::getInstance()->requireLogin();
$user = \smnbots\Auth::getInstance()->getCurrentUser();
$bot = new \smnbots\Bot(0);
$_LANG = \smnbots\translation::getPHP();
?>
<!DOCTYPE html>
<html lang="<?= $_LANG['HTML'] ?>">

<head>
	<script src="https://wchat.freshchat.com/js/widget.js"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>DSGVO | <?= $_LANG['BRAND_FULL'] ?></title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/sweetalert2.min.css" rel="stylesheet" />
    <link href="assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
    <link href="assets/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .faq .btn.btn-link{
            color: rgba(255, 255, 255, 0.8);
        }
        .faq .card-body{
            color: rgba(255, 255, 255, 0.7);
        }
    </style>
</head>

<body class="">
<div class="wrapper">
    <div class="sidebar" data-color="blue">
        <div class="sidebar-wrapper">
            <?php include 'assets/header.php'?>
            <ul class="nav">
				<li>
                    <a href="./dashboard">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>Zum Panel</p>
                    </a>
                </li>
				
                <li>
                    <a href="./impressum">
                        <i class="fas fa-info-circle"></i>
                        <p>Impressum</p>
                    </a>
                </li>
                <li class="active">
                    <a href="./datenschutz">
                        <i class="fas fa-info-circle"></i>
                        <p>Datenschutz</p>
                    </a>
                </li>
                <?php if (\smnbots\Auth::getInstance()->isAdmin()){ ?>
                    <li><hr></li>
                    <li>
                        <a href="./admin">
                            <i class="fas fa-cog"></i>
                            <p>Administration</p>
                        </a>
                    </li>
                <?php } ?>
            </ul>

        </div>
    </div>
    <div class="main-panel" data-color="blue">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle d-inline">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                              
                                <div class="card-body">
                                    <div id="accordion" class="imprint">
<h2>Datenschutzerklärung</h2><h3 id="dsg-general-intro"></h3><p>Diese Datenschutzerklärung klärt Sie über die Art, den Umfang und Zweck der Verarbeitung von personenbezogenen Daten (nachfolgend kurz „Daten“) im Rahmen der Erbringung unserer Leistungen sowie innerhalb unseres Onlineangebotes und der mit ihm verbundenen Webseiten, Funktionen und Inhalte sowie externen Onlinepräsenzen, wie z.B. unser Social Media Profile auf (nachfolgend gemeinsam bezeichnet als „Onlineangebot“). Im Hinblick auf die verwendeten Begrifflichkeiten, wie z.B. „Verarbeitung“ oder „Verantwortlicher“ verweisen wir auf die Definitionen im Art. 4 der Datenschutzgrundverordnung (DSGVO). <br>
<br>
</p><h3 id="dsg-general-controller">Verantwortlicher</h3><p><span class="tsmcontroller">Nico Bary<br>
MusterFirma<br>
<br>
Musterstraße 17<br>
12345 Musterstadt<br>
Muster<br>
<br>
Tel: auf anfrage<br>
E-Mail: recht@Muster.de<br>
<br>
Geschäftsführer: Nico Bary</span></p><h3 id="dsg-general-datatype">Arten der verarbeiteten Daten</h3><p>-	Bestandsdaten (z.B., Personen-Stammdaten, Namen oder Adressen).<br>
-	Kontaktdaten (z.B., E-Mail, Telefonnummern).<br>
-	Inhaltsdaten (z.B., Texteingaben, Fotografien, Videos).<br>
-	Nutzungsdaten (z.B., besuchte Webseiten, Interesse an Inhalten, Zugriffszeiten).<br>
-	Meta-/Kommunikationsdaten (z.B., Geräte-Informationen, IP-Adressen).</p><h3 id="dsg-general-datasubjects">Kategorien betroffener Personen</h3><p>Besucher und Nutzer des Onlineangebotes (Nachfolgend bezeichnen wir die betroffenen Personen zusammenfassend auch als „Nutzer“).<br>
</p><h3 id="dsg-general-purpose">Zweck der Verarbeitung</h3><p>-	Zurverfügungstellung des Onlineangebotes, seiner Funktionen und  Inhalte.<br>
-	Beantwortung von Kontaktanfragen und Kommunikation mit Nutzern.<br>
-	Sicherheitsmaßnahmen.<br>
-	Reichweitenmessung/Marketing<br>
<span class="tsmcom"></span></p><h3 id="dsg-general-terms">Verwendete Begrifflichkeiten </h3><p>„Personenbezogene Daten“ sind alle Informationen, die sich auf eine identifizierte oder identifizierbare natürliche Person (im Folgenden „betroffene Person“) beziehen; als identifizierbar wird eine natürliche Person angesehen, die direkt oder indirekt, insbesondere mittels Zuordnung zu einer Kennung wie einem Namen, zu einer Kennnummer, zu Standortdaten, zu einer Online-Kennung (z.B. Cookie) oder zu einem oder mehreren besonderen Merkmalen identifiziert werden kann, die Ausdruck der physischen, physiologischen, genetischen, psychischen, wirtschaftlichen, kulturellen oder sozialen Identität dieser natürlichen Person sind.<br>
<br>
„Verarbeitung“ ist jeder mit oder ohne Hilfe automatisierter Verfahren ausgeführte Vorgang oder jede solche Vorgangsreihe im Zusammenhang mit personenbezogenen Daten. Der Begriff reicht weit und umfasst praktisch jeden Umgang mit Daten.<br>
<br>
„Pseudonymisierung“ die Verarbeitung personenbezogener Daten in einer Weise, dass die personenbezogenen Daten ohne Hinzuziehung zusätzlicher Informationen nicht mehr einer spezifischen betroffenen Person zugeordnet werden können, sofern diese zusätzlichen Informationen gesondert aufbewahrt werden und technischen und organisatorischen Maßnahmen unterliegen, die gewährleisten, dass die personenbezogenen Daten nicht einer identifizierten oder identifizierbaren natürlichen Person zugewiesen werden.<br>
<br>
„Profiling“ jede Art der automatisierten Verarbeitung personenbezogener Daten, die darin besteht, dass diese personenbezogenen Daten verwendet werden, um bestimmte persönliche Aspekte, die sich auf eine natürliche Person beziehen, zu bewerten, insbesondere um Aspekte bezüglich Arbeitsleistung, wirtschaftliche Lage, Gesundheit, persönliche Vorlieben, Interessen, Zuverlässigkeit, Verhalten, Aufenthaltsort oder Ortswechsel dieser natürlichen Person zu analysieren oder vorherzusagen.<br>
<br>
Als „Verantwortlicher“ wird die natürliche oder juristische Person, Behörde, Einrichtung oder andere Stelle, die allein oder gemeinsam mit anderen über die Zwecke und Mittel der Verarbeitung von personenbezogenen Daten entscheidet, bezeichnet.<br>
<br>
„Auftragsverarbeiter“ eine natürliche oder juristische Person, Behörde, Einrichtung oder andere Stelle, die personenbezogene Daten im Auftrag des Verantwortlichen verarbeitet.<br>
</p><h3 id="dsg-general-legalbasis">Maßgebliche Rechtsgrundlagen</h3><p>Nach Maßgabe des Art. 13 DSGVO teilen wir Ihnen die Rechtsgrundlagen unserer Datenverarbeitungen mit.  Für Nutzer aus dem Geltungsbereich der Datenschutzgrundverordnung (DSGVO), d.h. der EU und des EWG gilt, sofern die Rechtsgrundlage in der Datenschutzerklärung nicht genannt wird, Folgendes: <br>
Die Rechtsgrundlage für die Einholung von Einwilligungen ist Art. 6 Abs. 1 lit. a und Art. 7 DSGVO;<br>
Die Rechtsgrundlage für die Verarbeitung zur Erfüllung unserer Leistungen und Durchführung vertraglicher Maßnahmen sowie Beantwortung von Anfragen ist Art. 6 Abs. 1 lit. b DSGVO;<br>
Die Rechtsgrundlage für die Verarbeitung zur Erfüllung unserer rechtlichen Verpflichtungen ist Art. 6 Abs. 1 lit. c DSGVO;<br>
Für den Fall, dass lebenswichtige Interessen der betroffenen Person oder einer anderen natürlichen Person eine Verarbeitung personenbezogener Daten erforderlich machen, dient Art. 6 Abs. 1 lit. d DSGVO als Rechtsgrundlage.<br>
Die Rechtsgrundlage für die erforderliche Verarbeitung zur Wahrnehmung einer Aufgabe, die im öffentlichen Interesse liegt oder in Ausübung öffentlicher Gewalt erfolgt, die dem Verantwortlichen übertragen wurde ist Art. 6 Abs. 1 lit. e DSGVO. <br>
Die Rechtsgrundlage für die Verarbeitung zur Wahrung unserer berechtigten Interessen ist Art. 6 Abs. 1 lit. f DSGVO. <br>
Die Verarbeitung von Daten zu anderen Zwecken als denen, zu denen sie erhoben wurden, bestimmt sich nach den Vorgaben des Art 6 Abs. 4 DSGVO. <br>
Die Verarbeitung von besonderen Kategorien von Daten (entsprechend Art. 9 Abs. 1 DSGVO) bestimmt sich nach den Vorgaben des Art. 9 Abs. 2 DSGVO. <br>
</p><h3 id="dsg-general-securitymeasures">Sicherheitsmaßnahmen</h3><p>Wir treffen nach Maßgabe der gesetzlichen Vorgabenunter Berücksichtigung des Stands der Technik, der Implementierungskosten und der Art, des Umfangs, der Umstände und der Zwecke der Verarbeitung sowie der unterschiedlichen Eintrittswahrscheinlichkeit und Schwere des Risikos für die Rechte und Freiheiten natürlicher Personen, geeignete technische und organisatorische Maßnahmen, um ein dem Risiko angemessenes Schutzniveau zu gewährleisten.<br>
<br>
Zu den Maßnahmen gehören insbesondere die Sicherung der Vertraulichkeit, Integrität und Verfügbarkeit von Daten durch Kontrolle des physischen Zugangs zu den Daten, als auch des sie betreffenden Zugriffs, der Eingabe, Weitergabe, der Sicherung der Verfügbarkeit und ihrer Trennung. Des Weiteren haben wir Verfahren eingerichtet, die eine Wahrnehmung von Betroffenenrechten, Löschung von Daten und Reaktion auf Gefährdung der Daten gewährleisten. Ferner berücksichtigen wir den Schutz personenbezogener Daten bereits bei der Entwicklung, bzw. Auswahl von Hardware, Software sowie Verfahren, entsprechend dem Prinzip des Datenschutzes durch Technikgestaltung und durch datenschutzfreundliche Voreinstellungen.<br>
</p><h3 id="dsg-general-coprocessing">Zusammenarbeit mit Auftragsverarbeitern, gemeinsam Verantwortlichen und Dritten</h3><p>Sofern wir im Rahmen unserer Verarbeitung Daten gegenüber anderen Personen und Unternehmen (Auftragsverarbeitern, gemeinsam Verantwortlichen oder Dritten) offenbaren, sie an diese übermitteln oder ihnen sonst Zugriff auf die Daten gewähren, erfolgt dies nur auf Grundlage einer gesetzlichen Erlaubnis (z.B. wenn eine Übermittlung der Daten an Dritte, wie an Zahlungsdienstleister, zur Vertragserfüllung erforderlich ist), Nutzer eingewilligt haben, eine rechtliche Verpflichtung dies vorsieht oder auf Grundlage unserer berechtigten Interessen (z.B. beim Einsatz von Beauftragten, Webhostern, etc.). <br>
<br>
Sofern wir Daten anderen Unternehmen unserer Unternehmensgruppe offenbaren, übermitteln oder ihnen sonst den Zugriff gewähren, erfolgt dies insbesondere zu administrativen Zwecken als berechtigtes Interesse und darüberhinausgehend auf einer den gesetzlichen Vorgaben entsprechenden Grundlage. <br>
</p><h3 id="dsg-general-thirdparty">Übermittlungen in Drittländer</h3><p>Sofern wir Daten in einem Drittland (d.h. außerhalb der Europäischen Union (EU), des Europäischen Wirtschaftsraums (EWR) oder der Schweizer Eidgenossenschaft) verarbeiten oder dies im Rahmen der Inanspruchnahme von Diensten Dritter oder Offenlegung, bzw. Übermittlung von Daten an andere Personen oder Unternehmen geschieht, erfolgt dies nur, wenn es zur Erfüllung unserer (vor)vertraglichen Pflichten, auf Grundlage Ihrer Einwilligung, aufgrund einer rechtlichen Verpflichtung oder auf Grundlage unserer berechtigten Interessen geschieht. Vorbehaltlich ausdrücklicher Einwilligung oder vertraglich erforderlicher Übermittlung, verarbeiten oder lassen wir die Daten nur in Drittländern mit einem anerkannten Datenschutzniveau, zu denen die unter dem "Privacy-Shield" zertifizierten US-Verarbeiter gehören oder auf Grundlage besonderer Garantien, wie z.B. vertraglicher Verpflichtung durch sogenannte Standardschutzklauseln der EU-Kommission, dem Vorliegen von Zertifizierungen oder verbindlichen internen Datenschutzvorschriften verarbeiten (Art. 44 bis 49 DSGVO, <a href="https://ec.europa.eu/info/law/law-topic/data-protection/data-transfers-outside-eu_de" target="blank">Informationsseite der EU-Kommission</a>).</p><h3 id="dsg-general-rightssubject">Rechte der betroffenen Personen</h3><p>Auskunftsrecht:  Sie haben das Recht, eine Bestätigung darüber zu verlangen, ob betreffende Daten verarbeitet werden und auf Auskunft über diese Daten sowie auf weitere Informationen und Kopie der Daten entsprechend den gesetzlichen Vorgaben.<br>
<br>
Recht auf Berichtigung: Sie haben entsprechend. den gesetzlichen Vorgaben das Recht, die Vervollständigung der Sie betreffenden Daten oder die Berichtigung der Sie betreffenden unrichtigen Daten zu verlangen.<br>
<br>
Recht auf Löschung und Einschränkung der Verarbeitung:  Sie haben nach Maßgabe der gesetzlichen Vorgaben das Recht zu verlangen, dass betreffende Daten unverzüglich gelöscht werden, bzw. alternativ nach Maßgabe der gesetzlichen Vorgaben eine Einschränkung der Verarbeitung der Daten zu verlangen.<br>
<br>
Recht auf Datenübertragbarkeit:  Sie haben das Recht, Sie betreffende Daten, die Sie uns bereitgestellt haben, nach Maßgabe der gesetzlichen Vorgaben in einem strukturierten, gängigen und maschinenlesbaren Format zu erhalten oder deren Übermittlung an einen anderen Verantwortlichen zu fordern.<br>
<br>
Beschwerde bei Aufsichtsbehörde:  Sie haben ferner nach Maßgabe der gesetzlichen Vorgaben das Recht, eine Beschwerde bei der zuständigen Aufsichtsbehörde einzureichen.<br>
</p><h3 id="dsg-general-revokeconsent">Widerrufsrecht</h3><p>Sie haben das Recht, erteilte Einwilligungen mit Wirkung für die Zukunft zu widerrufen.</p><h3 id="dsg-general-object">Widerspruchsrecht</h3><p><strong>Widerspruchsrecht: Sie haben das Recht, aus Gründen, die sich aus Ihrer besonderen Situation ergeben, jederzeit gegen die Verarbeitung der Sie betreffenden personenbezogenen Daten, die aufgrund von Art. 6 Abs. 1 lit. e oder f DSGVO erfolgt, Widerspruch einzulegen; dies gilt auch für ein auf diese Bestimmungen gestütztes Profiling. Werden die Sie betreffenden personenbezogenen Daten verarbeitet, um Direktwerbung zu betreiben, haben Sie das Recht, jederzeit Widerspruch gegen die Verarbeitung der Sie betreffenden personenbezogenen Daten zum Zwecke derartiger Werbung einzulegen; dies gilt auch für das Profiling, soweit es mit solcher Direktwerbung in Verbindung steht.</strong></p><h3 id="dsg-general-cookies">Cookies und Widerspruchsrecht bei Direktwerbung</h3><p>Als „Cookies“ werden kleine Dateien bezeichnet, die auf Rechnern der Nutzer gespeichert werden. Innerhalb der Cookies können unterschiedliche Angaben gespeichert werden. Ein Cookie dient primär dazu, die Angaben zu einem Nutzer (bzw. dem Gerät auf dem das Cookie gespeichert ist) während oder auch nach seinem Besuch innerhalb eines Onlineangebotes zu speichern. Als temporäre Cookies, bzw. „Session-Cookies“ oder „transiente Cookies“, werden Cookies bezeichnet, die gelöscht werden, nachdem ein Nutzer ein Onlineangebot verlässt und seinen Browser schließt. In einem solchen Cookie kann z.B. der Inhalt eines Warenkorbs in einem Onlineshop oder ein Login-Status gespeichert werden. Als „permanent“ oder „persistent“ werden Cookies bezeichnet, die auch nach dem Schließen des Browsers gespeichert bleiben. So kann z.B. der Login-Status gespeichert werden, wenn die Nutzer diese nach mehreren Tagen aufsuchen. Ebenso können in einem solchen Cookie die Interessen der Nutzer gespeichert werden, die für Reichweitenmessung oder Marketingzwecke verwendet werden. Als „Third-Party-Cookie“ werden Cookies bezeichnet, die von anderen Anbietern als dem Verantwortlichen, der das Onlineangebot betreibt, angeboten werden (andernfalls, wenn es nur dessen Cookies sind spricht man von „First-Party Cookies“).<br>
<br>
Wir können temporäre und permanente Cookies einsetzen und klären hierüber im Rahmen unserer Datenschutzerklärung auf.<br>
<br>
Sofern wir die Nutzer um eine Einwilligung in den Einsatz von Cookies bitten (z.B. im Rahmen einer Cookie-Einwilligung), ist die Rechtsgrundlage dieser Verarbeitung Art. 6 Abs. 1 lit. a. DSGVO. Ansonsten werden die personenbezogenen Cookies der Nutzer entsprechend den nachfolgenden Erläuterungen im Rahmen dieser Datenschutzerklärung auf Grundlage unserer berechtigten Interessen (d.h. Interesse an der Analyse, Optimierung und wirtschaftlichem Betrieb unseres Onlineangebotes im Sinne des Art. 6 Abs. 1 lit. f. DSGVO) oder sofern der Einsatz von Cookies zur Erbringung unserer vertragsbezogenen Leistungen erforderlich ist, gem. Art. 6 Abs. 1 lit. b. DSGVO, bzw. sofern der Einsatz von Cookies für die Wahrnehmung einer Aufgabe, die im öffentlichen Interesse liegt erforderlich ist oder in Ausübung öffentlicher Gewalt erfolgt, gem. Art. 6 Abs. 1 lit. e. DSGVO, verarbeitet.<br>
<br>
Falls die Nutzer nicht möchten, dass Cookies auf ihrem Rechner gespeichert werden, werden sie gebeten die entsprechende Option in den Systemeinstellungen ihres Browsers zu deaktivieren. Gespeicherte Cookies können in den Systemeinstellungen des Browsers gelöscht werden. Der Ausschluss von Cookies kann zu Funktionseinschränkungen dieses Onlineangebotes führen.<br>
<br>
Ein genereller Widerspruch gegen den Einsatz der zu Zwecken des Onlinemarketing eingesetzten Cookies kann bei einer Vielzahl der Dienste, vor allem im Fall des Trackings, über die US-amerikanische Seite <a href="http://www.aboutads.info/choices/">http://www.aboutads.info/choices/</a> oder die EU-Seite <a href="http://www.youronlinechoices.com/">http://www.youronlinechoices.com/</a> erklärt werden. Des Weiteren kann die Speicherung von Cookies mittels deren Abschaltung in den Einstellungen des Browsers erreicht werden. Bitte beachten Sie, dass dann gegebenenfalls nicht alle Funktionen dieses Onlineangebotes genutzt werden können.</p><h3 id="dsg-general-erasure">Löschung von Daten</h3><p>Die von uns verarbeiteten Daten werden nach Maßgabe der gesetzlichen Vorgaben gelöscht oder in ihrer Verarbeitung eingeschränkt. Sofern nicht im Rahmen dieser Datenschutzerklärung ausdrücklich angegeben, werden die bei uns gespeicherten Daten gelöscht, sobald sie für ihre Zweckbestimmung nicht mehr erforderlich sind und der Löschung keine gesetzlichen Aufbewahrungspflichten entgegenstehen. <br>
<br>
Sofern die Daten nicht gelöscht werden, weil sie für andere und gesetzlich zulässige Zwecke erforderlich sind, wird deren Verarbeitung eingeschränkt. D.h. die Daten werden gesperrt und nicht für andere Zwecke verarbeitet. Das gilt z.B. für Daten, die aus handels- oder steuerrechtlichen Gründen aufbewahrt werden müssen.</p><h3 id="dsg-general-changes">Änderungen und Aktualisierungen der Datenschutzerklärung</h3><p>Wir bitten Sie sich regelmäßig über den Inhalt unserer Datenschutzerklärung zu informieren. Wir passen die Datenschutzerklärung an, sobald die Änderungen der von uns durchgeführten Datenverarbeitungen dies erforderlich machen. Wir informieren Sie, sobald durch die Änderungen eine Mitwirkungshandlung Ihrerseits (z.B. Einwilligung) oder eine sonstige individuelle Benachrichtigung erforderlich wird.</p><p></p><h3 id="dsg-affiliate-general">Teilnahme an Affiliate-Partnerprogrammen</h3><p></p><p><span class="ts-muster-content">Innerhalb unseres Onlineangebotes setzen wir auf Grundlage unserer berechtigten Interessen (d.h. Interesse an der Analyse, Optimierung und wirtschaftlichem Betrieb unseres Onlineangebotes) gem. Art. 6 Abs. 1 lit. f DSGVO branchenübliche Trackingmaßnahmen ein, soweit diese für den Betrieb des Affiliatesystems erforderlich sind. Nachfolgend klären wir die Nutzer über die technischen Hintergründe auf.<br>
<br>
Die von unseren Vertragspartnern angebotene Leistungen können auch auf anderen Webseiten beworben und verlinkt werden (sog. Affiliate-Links oder After-Buy-Systeme, wenn z.B. Links oder Leistungen Dritter nach einem Vertragsschluss angeboten werden). Die Betreiber der jeweiligen Webseiten erhalten eine Provision, wenn Nutzer den Affiliate-Links folgen und anschließend die Angebote wahrnehmen.<br>
<br>
Zusammenfassend, ist es für unser Onlineangebot erforderlich, dass wir nachverfolgen können, ob Nutzer, die sich für Affiliate-Links und/oder die bei uns verfügbaren Angebote interessieren, die Angebote anschließend auf die Veranlassung der Affiliate-Links oder unserer Onlineplattform, wahrnehmen. Hierzu werden die Affiliate-Links und unsere Angebote um bestimmte Werte ergänzt, die ein Bestandteil des Links oder anderweitig, z.B. in einem Cookie, gesetzt werden können. Zu den Werten gehören insbesondere die Ausgangswebseite (Referrer), Zeitpunkt, eine Online-Kennung der Betreiber der Webseite, auf der sich der Affiliate-Link befand, eine Online-Kennung des jeweiligen Angebotes, eine Online-Kennung des Nutzers, als auch Tracking-spezifische Werte wie z.B. Werbemittel-ID, Partner-ID und Kategorisierungen.<br>
<br>
Bei der von uns verwendeten Online-Kennungen der Nutzer, handelt es sich um pseudonyme Werte. D.h. die Online-Kennungen enthalten selbst keine personenbezogenen Daten wie Namen oder E-Mailadressen. Sie helfen uns nur zu bestimmen ob derselbe Nutzer, der auf einen Affiliate-Link geklickt oder sich über unser Onlineangebot für ein Angebot interessiert hat, das Angebot wahrgenommen, d.h. z.B. einen Vertrag mit dem Anbieter abgeschlossen hat. Die Online-Kennung ist jedoch insoweit personenbezogen, als dem Partnerunternehmen und auch uns, die Online-Kennung zusammen mit anderen Nutzerdaten vorliegen. Nur so kann das Partnerunternehmen uns mitteilen, ob derjenige Nutzer das Angebot wahrgenommen hat und wir z.B. den Bonus auszahlen können.<br>
</span></p><p></p><h3 id="dsg-job-candidate">Datenschutzhinweise im Bewerbungsverfahren</h3><p></p><p><span class="ts-muster-content">Das Bewerbungsverfahren setzt voraus, dass Bewerber uns die für deren Beurteilung und Auswahl erforderlichen Daten mitteilen. Welche Informationen erforderlich sind, ergibt sich aus der Stellenbeschreibung oder im Fall von Onlineformularen aus den dortigen Angaben.<br>
Grundsätzlich gehören zu den erforderlichen Angaben, die Informationen zur Person, wie der Name, die Adresse, eine Kontaktmöglichkeit sowie die Nachweise über die für eine Stelle notwendigen Qualifikationen. Auf Anfragen teilen wir zusätzlich gerne mit, welche Angaben benötigt werden.<br>
Sofern zur Verfügung gestellt, können uns Bewerber ihre Bewerbungen mittels eines Onlineformulars übermitteln. Die Daten werden entsprechend dem Stand der Technik verschlüsselt an uns übertragen. Ebenfalls können Bewerber uns ihre Bewerbungen via E-Mail übermitteln. Hierbei bitten wir jedoch zu beachten, dass E-Mails im Internet grundsätzlich nicht verschlüsselt versendet werden. Im Regelfall werden E-Mails zwar auf dem Transportweg verschlüsselt, aber nicht auf den Servern von denen sie abgesendet und empfangen werden. Wir können daher für den Übertragungsweg der Bewerbung zwischen dem Absender und dem Empfang auf unserem Server keine Verantwortung übernehmen. Bewerber können uns gerne zur Art der Einreichung der Bewerbung kontaktieren oder uns die Bewerbung auf dem Postweg zuzusenden.<br>
Die von den Bewerbern zur Verfügung gestellten Daten, können im Fall einer erfolgreichen Bewerbung für die Zwecke des Beschäftigungsverhältnisses von uns weiterverarbeitet werden. Andernfalls, sofern die Bewerbung auf ein Stellenangebot nicht erfolgreich ist, werden die Daten der Bewerber gelöscht. Die Daten der Bewerber werden ebenfalls gelöscht, wenn eine Bewerbung zurückgezogen wird, wozu die Bewerber jederzeit berechtigt sind. Die Löschung erfolgt, vorbehaltlich eines berechtigten Widerrufs der Bewerber, spätestens nach dem Ablauf eines Zeitraums von sechs Monaten, damit wir etwaige Anschlussfragen zu der Bewerbung beantworten und unseren Nachweispflichten aus den Vorschriften zur Gleichbehandlung von Bewerbern nachkommen können. Rechnungen über etwaige Reisekostenerstattung werden entsprechend den steuerrechtlichen Vorgaben archiviert.<br>
Die Daten der Bewerber werden auf Grundlage von Art. 6 Abs. 1 S. 1 lit. b DSGVO verarbeitet (Bewerbungsverfahren als vorvertragliches, bzw. vertragliches Verhältnis). Soweit im Rahmen des Bewerbungsverfahrens besondere Kategorien von personenbezogenen Daten im Sinne des Art. 9 Abs. 1 DSGVO (z.B. Gesundheitsdaten, wie z.B. Schwerbehinderteneigenschaft oder ethnische Herkunft) bei Bewerbern angefragt werden, damit der Verantwortliche oder die betroffene Person die ihm bzw. ihr aus dem Arbeitsrecht und dem Recht der sozialen Sicherheit und des Sozialschutzes erwachsenden Rechte ausüben und seinen bzw. ihren diesbezüglichen Pflichten nachkommen kann, erfolgt deren Verarbeitung nach Art. 9 Abs. 2 lit. b. DSGVO, im Fall des Schutzes lebenswichtiger Interessen der Bewerber oder anderer Personen gem. Art. 9 Abs. 2 lit. c. DSGVO oder für Zwecke der Gesundheitsvorsorge oder der Arbeitsmedizin, für die Beurteilung der Arbeitsfähigkeit des Beschäftigten, für die medizinische Diagnostik, die Versorgung oder Behandlung im Gesundheits- oder Sozialbereich oder für die Verwaltung von Systemen und Diensten im Gesundheits- oder Sozialbereich gem. Art. 9 Abs. 2 lit. h. DSGVO. Im Fall einer auf freiwilliger Einwilligung beruhenden Mitteilung von besonderen Kategorien von Daten, erfolgt deren Verarbeitung auf Grundlage von Art. 9 Abs. 2 lit. a. DSGVO.<br>
Im Fall der Verarbeitung von Bewerberdaten in Deutschland gelten zusätzlich speziell die §§ 22, 26 BDSG.).  </span></p><p></p><h3 id="dsg-registration">Registrierfunktion</h3><p></p><p><span class="ts-muster-content">Nutzer können ein Nutzerkonto anlegen. Im Rahmen der Registrierung werden die erforderlichen Pflichtangaben den Nutzern mitgeteilt und auf Grundlage des Art. 6 Abs. 1 lit. b DSGVO zu Zwecken der Bereitstellung des Nutzerkontos verarbeitet. Zu den verarbeiteten Daten gehören insbesondere die Login-Informationen (Name, Passwort sowie eine E-Mailadresse). Die im Rahmen der Registrierung eingegebenen Daten werden für die Zwecke der Nutzung des Nutzerkontos und dessen Zwecks verwendet. <br>
<br>
Die Nutzer können über Informationen, die für deren Nutzerkonto relevant sind, wie z.B. technische Änderungen, per E-Mail informiert werden. Wenn Nutzer ihr Nutzerkonto gekündigt haben, werden deren Daten im Hinblick auf das Nutzerkonto, vorbehaltlich einer gesetzlichen Aufbewahrungspflicht, gelöscht. Es obliegt den Nutzern, ihre Daten bei erfolgter Kündigung vor dem Vertragsende zu sichern. Wir sind berechtigt, sämtliche während der Vertragsdauer gespeicherten Daten des Nutzers unwiederbringlich zu löschen.<br>
<br>
Im Rahmen der Inanspruchnahme unserer Registrierungs- und Anmeldefunktionen sowie der Nutzung des Nutzerkontos, speichern wir die IP-Adresse und den Zeitpunkt der jeweiligen Nutzerhandlung. Die Speicherung erfolgt auf Grundlage unserer berechtigten Interessen, als auch der Nutzer an Schutz vor Missbrauch und sonstiger unbefugter Nutzung. Eine Weitergabe dieser Daten an Dritte erfolgt grundsätzlich nicht, außer sie ist zur Verfolgung unserer Ansprüche erforderlich oder es besteht hierzu besteht eine gesetzliche Verpflichtung gem. Art. 6 Abs. 1 lit. c. DSGVO. Die IP-Adressen werden spätestens nach 7 Tagen anonymisiert oder gelöscht.<br>
</span></p><p></p><h3 id="dsg-comments">Kommentare und Beiträge</h3><p></p><p><span class="ts-muster-content">Wenn Nutzer Kommentare oder sonstige Beiträge hinterlassen, können ihre IP-Adressen auf Grundlage unserer berechtigten Interessen im Sinne des Art. 6 Abs. 1 lit. f. DSGVO für 7 Tage gespeichert werden. Das erfolgt zu unserer Sicherheit, falls jemand in Kommentaren und Beiträgen widerrechtliche Inhalte hinterlässt (Beleidigungen, verbotene politische Propaganda, etc.). In diesem Fall können wir selbst für den Kommentar oder Beitrag belangt werden und sind daher an der Identität des Verfassers interessiert.<br>
<br>
Des Weiteren behalten wir uns vor, auf Grundlage unserer berechtigten Interessen gem. Art. 6 Abs. 1 lit. f. DSGVO, die Angaben der Nutzer zwecks Spamerkennung zu verarbeiten.<br>
<br>
Auf derselben Rechtsgrundlage behalten wir uns vor, im Fall von Umfragen die IP-Adressen der Nutzer für deren Dauer zu speichern und Cookies zu verwenden, um Mehrfachabstimmungen zu vermeiden.<br>
<br>
Die im Rahmen der Kommentare und Beiträge mitgeteilte Informationen zur Person, etwaige Kontakt- sowie Websiteinformationen als auch die inhaltlichen Angaben, werden von uns bis zum Widerspruch der Nutzer dauerhaft gespeichert.</span></p><p></p><h3 id="dsg-subscribetocomments">Kommentarabonnements</h3><p></p><p><span class="ts-muster-content">Die Nachfolgekommentare können durch Nutzer mit deren Einwilligung gem. Art. 6 Abs. 1 lit. a DSGVO abonniert werden. Die Nutzer erhalten eine Bestätigungsemail, um zu überprüfen, ob sie der Inhaber der eingegebenen Emailadresse sind. Nutzer können laufende Kommentarabonnements jederzeit abbestellen. Die Bestätigungsemail wird Hinweise zu den Widerrufsmöglichkeiten enthalten. Für die Zwecke des Nachweises der Einwilligung der Nutzer, speichern wir den Anmeldezeitpunkt nebst der IP-Adresse der Nutzer und löschen diese Informationen, wenn Nutzer sich von dem Abonnement abmelden.<br>
<br>
Sie können den Empfang unseres Abonnements jederzeit kündigen, d.h. Ihre Einwilligungen widerrufen.  Wir können die ausgetragenen E-Mailadressen bis zu drei Jahren auf Grundlage unserer berechtigten Interessen speichern bevor wir sie löschen, um eine ehemals gegebene Einwilligung nachweisen zu können. Die Verarbeitung dieser Daten wird auf den Zweck einer möglichen Abwehr von Ansprüchen beschränkt. Ein individueller Löschungsantrag ist jederzeit möglich, sofern zugleich das ehemalige Bestehen einer Einwilligung bestätigt wird.</span></p><p></p><h3 id="dsg-akismet">Akismet Anti-Spam-Prüfung</h3><p></p><p><span class="ts-muster-content">Unser Onlineangebot nutzt den Dienst „Akismet“, der von der Automattic Inc., 60 29th Street #343, San Francisco, CA 94110, USA, angeboten wird. Die Nutzung erfolgt auf Grundlage unserer berechtigten Interessen im Sinne des Art. 6 Abs. 1 lit. f) DSGVO. Mit Hilfe dieses Dienstes werden Kommentare echter Menschen von Spam-Kommentaren unterschieden. Dazu werden alle Kommentarangaben an einen Server in den USA verschickt, wo sie analysiert und für Vergleichszwecke vier Tage lang gespeichert werden. Ist ein Kommentar als Spam eingestuft worden, werden die Daten über diese Zeit hinaus gespeichert. Zu diesen Angaben gehören der eingegebene Name, die Emailadresse, die IP-Adresse, der Kommentarinhalt, der Referrer, Angaben zum verwendeten Browser sowie dem Computersystem und die Zeit des Eintrags.<br>
<br>
Nähere Informationen zur Erhebung und Nutzung der Daten durch Akismet finden sich in den Datenschutzhinweisen von Automattic: <a target="_blank" href="https://automattic.com/privacy/">https://automattic.com/privacy/</a>.<br>
<br>
Nutzer können gerne Pseudonyme nutzen, oder auf die Eingabe des Namens oder der Emailadresse verzichten. Sie können die Übertragung der Daten komplett verhindern, indem Sie unser Kommentarsystem nicht nutzen. Das wäre schade, aber leider sehen wir sonst keine Alternativen, die ebenso effektiv arbeiten.<br>
<br>
</span></p><p></p><h3 id="dsg-gravatar">Abruf von Profilbildern bei Gravatar</h3><p></p><p><span class="ts-muster-content">Wir setzen innerhalb unseres Onlineangebotes und insbesondere im Blog den Dienst Gravatar der Automattic Inc., 60 29th Street #343, San Francisco, CA 94110, USA, ein.<br>
<br>
Gravatar ist ein Dienst, bei dem sich Nutzer anmelden und Profilbilder und ihre E-Mailadressen hinterlegen können. Wenn Nutzer mit der jeweiligen E-Mailadresse auf anderen Onlinepräsenzen (vor allem in Blogs) Beiträge oder Kommentare hinterlassen, können so deren Profilbilder neben den Beiträgen oder Kommentaren dargestellt werden. Hierzu wird die von den Nutzern mitgeteilte E-Mailadresse an Gravatar zwecks Prüfung, ob zu ihr ein Profil gespeichert ist, verschlüsselt übermittelt. Dies ist der einzige Zweck der Übermittlung der E-Mailadresse und sie wird nicht für andere Zwecke verwendet, sondern danach gelöscht.<br>
<br>
Die Nutzung von Gravatar erfolgt auf Grundlage unserer berechtigten Interessen im Sinne des Art. 6 Abs. 1 lit. f) DSGVO, da wir mit Hilfe von Gravatar den Beitrags- und Kommentarverfassern die Möglichkeit bieten ihre Beiträge mit einem Profilbild zu personalisieren.<br>
<br>
Durch die Anzeige der Bilder bringt Gravatar die IP-Adresse der Nutzer in Erfahrung, da dies für eine Kommunikation zwischen einem Browser und einem Onlineservice notwendig ist. Nähere Informationen zur Erhebung und Nutzung der Daten durch Gravatar finden sich in den Datenschutzhinweisen von Automattic: <a target="_blank" href="https://automattic.com/privacy/">https://automattic.com/privacy/</a>.<br>
<br>
Wenn Nutzer nicht möchten, dass ein mit Ihrer E-Mail-Adresse bei Gravatar verknüpftes Benutzerbild in den Kommentaren erscheint, sollten Sie zum Kommentieren eine E-Mail-Adresse nutzen, welche nicht bei Gravatar hinterlegt ist. Wir weisen ferner darauf hin, dass es auch möglich ist eine anonyme oder gar keine E-Mailadresse zu verwenden, falls die Nutzer nicht wünschen, dass die eigene E-Mailadresse an Gravatar übersendet wird. Nutzer können die Übertragung der Daten komplett verhindern, indem Sie unser Kommentarsystem nicht nutzen.</span></p><p></p><h3 id="dsg-musicpodcast-soundcloud">Soundcloud</h3><p></p><p><span class="ts-muster-content">Unsere Podcasts werden auf der Plattform „Soundcloud“, angeboten von SoundCloud Limited, Rheinsberger Str. 76/77, 10115 Berlin, Deutschland gespeichert und werden von dieser aus Platform wiedergegeben.<br>
<br>
Zu diesem Zweck binden wir sog. Soundcloud-Widgets in unsere Website ein. Dabei handelt es sich um Abspielsoftware, mit der Nutzer die Podcasts abspielen können. Hierbei kann Soundcloud messen, welche Podcasts in welchem Umfang gehört werden und diese Information pseudonym für statistische und betriebswirtschaftliche Zwecke verarbeiten. Hierzu können Cookies in den Browsern der Nuzer gespeichert und zwecks Bildung von Nutzerprofilen, z.B. für Zwecke der Ausgabee von Anzeigen, die den potentiellen Interessen der Nutzer entsprechen, verarbeitet werden. Im Fall von Nutzern, die bei Soundcloud registriert sind, kann Soundcloud die Hörinformationen deren Profilen zuordnen.<br>
<br>
Die Nutzung erfolgt auf Grundlage unserer berechtigten Interessen, d.h. Interesse an einer sicheren und effizienten Bereitstellung, Analyse sowie Optimierung unseres Audioangebotes gem. Art. 6 Abs. 1 lit. f. DSGVO. <br>
<br>
Weitere Informationen und Widerspruchsmöglichkeiten finden sich in der Datenschutzerklärung von Soundcloud: <a target="_blank" href="https://soundcloud.com/pages/privacy">https://soundcloud.com/pages/privacy</a>.</span></p><p></p><h3 id="dsg-contact">Kontaktaufnahme</h3><p></p><p><span class="ts-muster-content">Bei der Kontaktaufnahme mit uns (z.B. per Kontaktformular, E-Mail, Telefon oder via sozialer Medien) werden die Angaben des Nutzers zur Bearbeitung der Kontaktanfrage und deren Abwicklung gem. Art. 6 Abs. 1 lit. b. (im Rahmen vertraglicher-/vorvertraglicher Beziehungen),  Art. 6 Abs. 1 lit. f. (andere Anfragen) DSGVO verarbeitet.. Die Angaben der Nutzer können in einem Customer-Relationship-Management System ("CRM System") oder vergleichbarer Anfragenorganisation gespeichert werden.<br>
<br>
Wir löschen die Anfragen, sofern diese nicht mehr erforderlich sind. Wir überprüfen die Erforderlichkeit alle zwei Jahre; Ferner gelten die gesetzlichen Archivierungspflichten.</span></p><p></p><h3 id="dsg-whatsapp">Kommunikation via WhatsApp-Messenger</h3><p></p><p><span class="ts-muster-content">Wir setzen zu Zwecken der Kommunikation den WhatsApp-Messenger ein und bitten Sie die nachfolgenden Hinweise zu der Funktionsfähigkeit, der Verschlüsselung, Risiken von WhatsApp, Nutzung der Metadaten innerhalb der Facebook-Unternehmensgruppe und Ihren Widerspruchsmöglichkeiten zu beachten.<br>
<br>
Sie müssen WhatsApp nicht nutzen und können uns auf alternativen Wegen, z.B. via Telefon oder E-Mail kontaktieren. Bitte nutzen Sie die Ihnen mitgeteilten Kontaktmöglichkeiten oder nutzen die angegebenen Kontaktmöglichkeiten auf unserer Webseite.<br>
Bei WhatsApp (WhatsApp Inc. WhatsApp Legal 1601 Willow Road Menlo Park, California 94025, USA) handelt es sich um einen US-Amerikanischen Dienst, was bedeutet, dass die von Ihnen via WhatsApp übersandten Daten zuerst an WhatsApp in die USA übermittelt werden können, bevor sie uns zugeleitet werden.<br>
<br>
WhatsApp ist jedoch unter dem Privacy-Shield-Abkommen zertifiziert und sichert daher zu, das europäische und das schweizer Datenschutzrecht einzuhalten (<a target="_blank" href="https://www.privacyshield.gov/participant?id=a2zt0000000TSnwAAG&status=Active">https://www.privacyshield.gov/participant?id=a2zt0000000TSnwAAG&status=Active</a>).<br>
WhatsApp sichert ebenfalls zu, dass die Kommunikationsinhalte (d.h. der Inhalt Ihrer Nachricht und angehängte Bilder) Ende-zu-Ende verschlüsselt werden. Das bedeutet, dass der Inhalt der Nachrichten nicht einsehbar ist, nicht einmal durch WhatsApp selbst. Sie sollten immer eine aktuelle Version von WhatsApp nutzen, damit die Verschlüsselung der Nachrichteninhalte sichergestellt ist.<br>
<br>
Wir weisen unsere Kommunikationspartner jedoch darauf hin, dass WhatsApp zwar nicht den Inhalt sehen, aber in Erfahrung bringen kann, dass und wann Kommunikationspartner mit uns kommunizieren sowie technische Informationen zum verwendeten Gerät der Kommunikationspartner und je nach Einstellungen ihres Gerätes auch Standortinformationen (sog. Metadaten) verarbeitet. Bis auf die verschlüsselten Inhalte, ist eine Übermittlung der Daten der Kommunikationspartner innerhalb der Facebook-Unternehmensgruppe, insbesondere zu Zwecken der Optimierung der jeweiligen Dienste und Zwecken der Sicherheit, möglich. Ebenfalls sollten Kommunikationspartner, zumindest solange sie dem nicht widersprochen haben, davon ausgehen, dass ihre von WhatsApp verarbeiteten Daten für Zwecke des Marketings oder Anzeige auf Nutzer zugeschnittener Werbung verwendet werden können.<br>
<br>
Sofern wir Kommunikationspartner um eine Einwilligung vor der Kommunikation mit ihnen via WhatsApp bitten, ist die Rechtsgrundlage unserer Verarbeitung ihrer Daten Art. 6 Abs. 1 lit. a. DSGVO. Im Übrigen, falls wir nicht um eine Einwilligung bitten und sie z.B. von sich aus Kontakt mit uns aufnehmen, nutzen wir WhatsApp im Verhältnis zu unseren Vertragspartnern sowie im Rahmen der Vertragsanbahnung als eine vertragliche Maßnahme gem. Art. 6 Abs. 1 lit. b. DSGVO und im Fall anderer Interessenten und Kommunikationspartner auf Grundlage unserer berechtigten Interessen an einer schnellen und effizienten Kommunikation und Erfüllung der Bedürfnisse unser Kommunikationspartner an der Kommunikation via Messengern gem. Art. 6 Abs. 1 lit. f. DSGVO.<br>
<br>
Weitere Angaben zu Zwecken, Arten und Umfang der Verarbeitung Ihrer Daten durch WhatsApp, sowie die diesbezüglichen Rechte und Einstellungsmöglichkeiten zum Schutz Ihrer Privatsphäre, können Sie den Datenschutzhinweisen von WhatsApp entnehmen: <a target="_blank" href="https://www.whatsapp.com/legal">https://www.whatsapp.com/legal</a>.<br>
<br>
Sie können der Kommunikation mit uns via WhatsApp jederzeit widersprechen. Im Fall des Abonnements von Nachrichten (auch bekannt als „Broadcasts“) über WhatsApp können Sie unsere entsprechende Telefonnummer aus deren Kontakten löschen sowie uns zur Austragung Ihres Kontaktes aus unserem Verzeichnis auffordern. Bei laufenden individuellen Anfragen oder Kommunikationen, können Sie uns ebenfalls auffordern, die Kommunikation nicht über WhatsApp fortzusetzen sowie die Kommunikationsinhalte zu löschen. <br>
<br>
Im Fall der Kommunikation via WhatsApp löschen wir die WhatsApp-Nachrichten, sobald wir davon ausgehen können, etwaige Auskünfte der Nutzer beantwortet zu haben, wenn kein Rückbezug auf eine vorhergehende Konversation zu erwarten ist und der Löschung keine gesetzlichen Aufbewahrungspflichten entgegenstehen.<br>
<br>
Ferner weisen wir Sie darauf hin, dass wir die uns mitgeteilten Kontaktdaten ohne Ihre Einwilligung nicht an WhatsApp übermitteln (z.B., durch eine von uns ausgehende Kontaktaufnahme mit Ihnen via WhatsApp).<br>
<br>
Zum Abschluss möchten wir darauf hinweisen, dass wir uns aus Gründen Ihrer Sicherheit vorbehalten, Anfragen über WhatsApp nicht zu beantworten. Das ist der Fall, wenn z.B. Vertragsinterna besonderer Geheimhaltung bedürfen oder eine Antwort über den Messenger den formellen Ansprüchen nicht genügt. In solchen Fällen verweisen wir Sie auf adäquatere Kommunikationswege.</span></p><p></p><h3 id="dsg-fb-messenger">Kommunikation via Facebook-Messenger</h3><p></p><p><span class="ts-muster-content">Wir setzen zu Zwecken der Kommunikation den Facebook-Messenger ein und bitten Sie die nachfolgenden Hinweise zu der Funktionsfähigkeit, der Verschlüsselung, Risiken des Facebook-Messengers, Nutzung der Metadaten innerhalb der Facebook-Unternehmensgruppe und Ihren Widerspruchsmöglichkeiten zu beachten.<br>
Sie müssen den Facebook-Messenger nicht nutzen und können uns auf alternativen Wegen, z.B. via Telefon oder E-Mail kontaktieren. Bitte nutzen Sie die Ihnen mitgeteilten Kontaktmöglichkeiten oder nutzen die angegebenen Kontaktmöglichkeiten auf unserer Webseite.<br>
<br>
Der Facebook-Messenger wird von der Facebook Ireland Ltd., 4 Grand Canal Square, Grand Canal Harbour, Dublin 2, Irland angeboten, wobei die im Rahmen der Kommunikation eingegebenen und sonst erhobenen Daten in den USA durch die Facebook, 1 Hacker Way, Menlo Park, CA 94025, USA verarbeitet werden.<br>
<br>
Facebook ist jedoch unter dem Privacy-Shield-Abkommen zertifiziert und sichert daher zu, das europäische und das Schweizer Datenschutzrecht einzuhalten (<a target="_blank" href="https://www.privacyshield.gov/participant?id=a2zt0000000GnywAAC&status=Active">https://www.privacyshield.gov/participant?id=a2zt0000000GnywAAC&status=Active</a>).<br>
<br>
Facebook sichert ebenfalls zu, dass die Kommunikationsinhalte (d.h. der Inhalt Ihrer Nachricht und angehängte Bilder) nicht zu lesen und bietet eine Ende-zu-Ende-Verschlüsselung der Inhalte an. Das bedeutet, dass der Inhalt der Nachrichten nicht einsehbar ist, nicht einmal durch Facebook selbst. Die Ende-zu-Ende-Verschlüsselung setzt jedoch eine Aktivierung voraus, die Sie in Ihren Messenger-Einstellungen mit dem Menüpunkt „Geheime Unterhaltungen“ aktivieren müssen. Sie sollten immer eine aktuelle Version des Facebook-Messengers nutzen, damit die Verschlüsselung der Nachrichteninhalte sichergestellt ist.<br>
<br>
Wir weisen unsere Kommunikationspartner darauf hin, dass Facebook auch im Fall einer aktivierten Verschlüsselung in Erfahrung bringen kann, dass und wann Kommunikationspartner mit uns kommunizieren sowie technische Informationen zum verwendeten Gerät der Kommunikationspartner und je nach Einstellungen ihres Gerätes auch Standortinformationen (sog. Metadaten) verarbeitet. Bis auf die verschlüsselten Inhalte, ist eine Übermittlung der Daten der Kommunikationspartner innerhalb der Facebook-Unternehmensgruppe, insbesondere zu Zwecken der Optimierung der jeweiligen Dienste und Zwecken der Sicherheit, möglich. Ebenfalls sollten Kommunikationspartner, zumindest solange sie dem nicht widersprochen haben, davon ausgehen, dass ihre durch den Facebook-Messenger verarbeiteten Daten für Zwecke des Marketings oder Anzeige auf Nutzer zugeschnittener Werbung verwendet werden können.<br>
<br>
Sofern wir Kommunikationspartner um eine Einwilligung vor der Kommunikation mit ihnen via des Facebook-Messengers bitten, ist die Rechtsgrundlage unserer Verarbeitung ihrer Daten Art. 6 Abs. 1 lit. a. DSGVO. Im Übrigen, falls wir nicht um eine Einwilligung bitten und sie z.B. von sich aus Kontakt mit uns aufnehmen, nutzen wir WhatsApp im Verhältnis zu unseren Vertragspartnern sowie im Rahmen der Vertragsanbahnung als eine vertragliche Maßnahme gem. Art. 6 Abs. 1 lit. b. DSGVO und im Fall anderer Interessenten und Kommunikationspartner auf Grundlage unserer berechtigten Interessen an einer schnellen und effizienten Kommunikation und Erfüllung der Bedürfnisse unser Kommunikationspartner an der Kommunikation via Messengern gem. Art. 6 Abs. 1 lit. f. DSGVO.<br>
<br>
Weitere Angaben zu Zwecken, Arten und Umfang der Verarbeitung Ihrer Daten durch Facebook, sowie die diesbezüglichen Rechte und Einstellungsmöglichkeiten zum Schutz Ihrer Privatsphäre, können Sie den Datenschutzhinweisen von Facebook entnehmen: <a target="_blank" href="https://www.facebook.com/about/privacy">https://www.facebook.com/about/privacy</a>. <br>
<br>
Sie können der Kommunikation mit uns via Facebook-Messenger jederzeit widersprechen und uns auffordern, die Kommunikation nicht über den Facebook-Messenger fortzusetzen sowie die Kommunikationsinhalte zu löschen. Wir löschen  die Facebook-Nachrichten, sobald wir davon ausgehen können, etwaige Auskünfte der Nutzer beantwortet zu haben, wenn kein Rückbezug auf eine vorhergehende Konversation zu erwarten ist und der Löschung keine gesetzlichen Aufbewahrungspflichten entgegenstehen.<br>
<br>
Zum Abschluss möchten wir darauf hinweisen, dass wir uns aus Gründen Ihrer Sicherheit vorbehalten, Anfragen mittels des Facebook-Messengers nicht zu beantworten. Das ist der Fall, wenn z.B. Vertragsinterna besonderer Geheimhaltung bedürfen oder eine Antwort über den Messenger den formellen Ansprüchen nicht genügt. In solchen Fällen verweisen wir Sie auf adäquatere Kommunikationswege.</span></p><p></p><h3 id="dsg-fb-messenger-chatbot">Chatbot im Facebook-Messenger</h3><p></p><p><span class="ts-muster-content">Wir bieten als Kommunikationsmöglichkeit einen so genannten „Chatbot“ an. Bei dem Chatbot handelt es sich um eine Software, die Fragen der Nutzer beantwortet oder sie über Nachrichten informiert. Unser Chat-Bot ist über die „Facebook-Messenger“ Plattform abrufbar.<br>
<br>
Wenn Sie sich mit unserem Chatbot unterhalten, können wir Ihre personenbezogenen Daten verarbeiten. In diesem Fall wird Ihre Facebook-ID in unserem System gespeichert und wir können erkennen, welche Nutzer wann mit unserem Chat-Bot interagieren. Ferner speichern wir den Inhalt Ihrer mit dem Chatbot ausgetauschten Konversation. Des Weiteren erhalten wir von Facebook automatisch Zugriff auf Ihre "öffentlichen Informationen", die bei Facebook gespeichert sind. Hierzu gehört Ihr Name, das Profil- und Titelbild, das Geschlecht, die Netzwerke (z.B. Schule oder Arbeitsstelle), der Nutzername (Facebook URL) und die Nutzerkennnummer (Facebook ID). Wir verwenden diese Informationen nur, um unseren Chat-Bot zu betreiben, z.B. damit er Sie persönlich ansprechen kann.<br>
<br>
Sofern Sie beim Chatbot die Informationen mit regelmäßigen Nachrichten aktivieren, steht Ihnen jederzeit die Möglichkeit zur Verfügung, die Informationen für die Zukunft abzubestellen. Der Chatbot weist Sie darauf hin, wie und mit welchen Begriffen Sie die Nachrichten abbestellen können. Mit dem Abbestellen der Chatbotnachrichten, werden Ihre Daten aus dem Verzeichnis der Nachrichtenempfänger gelöscht. Chatprotokolle werden von uns anonymisiert, d.h. die Nutzernamen und Nutzer-IDs werden automatisch gelöscht oder anonymisiert.<br>
<br>
Die vorgenannten Angaben nutzen wir, um unseren Chat-Bot zu betreiben, z.B. um Sie persönlich anzusprechen, um Ihre Anfragen gegenüber dem Chatbot zu beantworten, etwaige angeforderte Inhalte zu übermitteln, als auch um unseren Chat-Bot zu verbessern (z.B. um ihm Antworten auf häufig gestellte Fragen „beizubringen“ oder unbeantwortete Anfragen zu erkennen).<br>
<br>
Wir setzen den Chatbot zum einen auf Grundlage des Art. 6 Abs. 1 lit. a. DSGVO ein, wenn wir zur Nutzung eine Einwilligung der Nutzer einholen (dies gilt für die Fälle, in denen Nutzer um eine Einwilligung gebeten werden, z.B. damit der Chatbot ihnen regelmäßig Nachrichten zusendet). Sofern wir den Chatbot einsetzen, um Anfragen der Nutzer zu unseren Leistungen oder unserem Unternehmen zu beantworten, erfolgt dies gem. Art. 6 Abs. 1 lit. b. DSGVO. Im Übrigen setzen wir den Chatbot auf Grundlage unserer berechtigten Interessen an einer Optimierung des Chatbots, effizienter und angenehmer Ansprache der Nutzer zu Informations-, Werbe- und Marketingzwecken sowie Steigerung der positiven Nutzererfahrung gem. Art. 6 Abs. 1 lit. f. DSGVO ein.<br>
<br>
Die Nutzung des Chatbots setzt eine Registrierung auf der Plattform Facebook und Nutzung der Kommunikationsplattform Facebook-Messenger voraus. Der Facebook-Messenger wird von der Facebook Ireland Ltd., 4 Grand Canal Square, Grand Canal Harbour, Dublin 2, Irland angeboten, wobei die im Rahmen der Kommunikation eingegebenen und sonst erhobenen Daten in den USA durch die Facebook, 1 Hacker Way, Menlo Park, CA 94025, USA verarbeitet werden.<br>
Facebook ist jedoch unter dem Privacy-Shield-Abkommen zertifiziert und sichert daher zu, das europäische und das Schweizer Datenschutzrecht einzuhalten (<a target="_blank" href="https://www.privacyshield.gov/participant?id=a2zt0000000GnywAAC&status=Active">https://www.privacyshield.gov/participant?id=a2zt0000000GnywAAC&status=Active</a>).<br>
<br>
Wir weisen Sie, darauf hin, dass Facebook in Erfahrung bringen kann, dass und wann Nutzer mit unserem Chatbot kommunizieren sowie technische Informationen zum verwendeten Gerät der Nutzer und je nach Einstellungen ihres Gerätes auch Standortinformationen (sog. Metadaten) verarbeitet. Ferner ist eine Übermittlung der Daten der Nutzer innerhalb der Facebook-Unternehmensgruppe, insbesondere zu Zwecken der Optimierung der jeweiligen Dienste und Zwecken der Sicherheit, möglich. Ebenfalls sollten Nutzer davon ausgehen, dass ihre durch den Chatbot verarbeiteten Daten für Zwecke des Marketings oder Anzeige auf Nutzer zugeschnittener Werbung verwendet werden können.<br>
<br>
Für weitere Informationen zur Facebooks Datennutzung, verweisen wir auf die Datenschutzerklärung von Facebook: <a target="_blank" href="https://www.facebook.com/about/privacy">https://www.facebook.com/about/privacy</a>.<br>
</span></p><p></p><h3 id="dsg-newsletter-de">Newsletter</h3><p></p><p><span class="ts-muster-content">Mit den nachfolgenden Hinweisen informieren wir Sie über die Inhalte unseres Newsletters sowie das Anmelde-, Versand- und das statistische Auswertungsverfahren sowie Ihre Widerspruchsrechte auf. Indem Sie unseren Newsletter abonnieren, erklären Sie sich mit dem Empfang und den beschriebenen Verfahren einverstanden.<br>
<br>
Inhalt des Newsletters: Wir versenden Newsletter, E-Mails und weitere elektronische Benachrichtigungen mit werblichen Informationen (nachfolgend „Newsletter“) nur mit der Einwilligung der Empfänger oder einer gesetzlichen Erlaubnis. Sofern im Rahmen einer Anmeldung zum Newsletter dessen Inhalte konkret umschrieben werden, sind sie für die Einwilligung der Nutzer maßgeblich. Im Übrigen enthalten unsere Newsletter Informationen zu unseren Leistungen und uns.<br>
<br>
Double-Opt-In und Protokollierung: Die Anmeldung zu unserem Newsletter erfolgt in einem sog. Double-Opt-In-Verfahren. D.h. Sie erhalten nach der Anmeldung eine E-Mail, in der Sie um die Bestätigung Ihrer Anmeldung gebeten werden. Diese Bestätigung ist notwendig, damit sich niemand mit fremden E-Mailadressen anmelden kann. Die Anmeldungen zum Newsletter werden protokolliert, um den Anmeldeprozess entsprechend den rechtlichen Anforderungen nachweisen zu können. Hierzu gehört die Speicherung des Anmelde- und des Bestätigungszeitpunkts, als auch der IP-Adresse. Ebenso werden die Änderungen Ihrer bei dem Versanddienstleister gespeicherten Daten protokolliert.<br>
<br>
Anmeldedaten: Um sich für den Newsletter anzumelden, reicht es aus, wenn Sie Ihre E-Mailadresse angeben. Optional bitten wir Sie einen Namen, zwecks persönlicher Ansprache im Newsletters anzugeben.<br>
<br>
Der Versand des Newsletters und die mit ihm verbundene Erfolgsmessung erfolgen auf Grundlage einer Einwilligung der Empfänger gem. Art. 6 Abs. 1 lit. a, Art. 7 DSGVO i.V.m § 7 Abs. 2 Nr. 3 UWG oder falls eine Einwilligung nicht erforderlich ist, auf Grundlage unserer berechtigten Interessen am Direktmarketing gem. Art. 6 Abs. 1 lt. f. DSGVO i.V.m. § 7 Abs. 3 UWG. <br>
<br>
Die Protokollierung des Anmeldeverfahrens erfolgt auf Grundlage unserer berechtigten Interessen gem. Art. 6 Abs. 1 lit. f DSGVO. Unser Interesse richtet sich auf den Einsatz eines nutzerfreundlichen sowie sicheren Newslettersystems, das sowohl unseren geschäftlichen Interessen dient, als auch den Erwartungen der Nutzer entspricht und uns ferner den Nachweis von Einwilligungen erlaubt.<br>
<br>
Kündigung/Widerruf - Sie können den Empfang unseres Newsletters jederzeit kündigen, d.h. Ihre Einwilligungen widerrufen. Einen Link zur Kündigung des Newsletters finden Sie am Ende eines jeden Newsletters. Wir können die ausgetragenen E-Mailadressen bis zu drei Jahren auf Grundlage unserer berechtigten Interessen speichern bevor wir sie löschen, um eine ehemals gegebene Einwilligung nachweisen zu können. Die Verarbeitung dieser Daten wird auf den Zweck einer möglichen Abwehr von Ansprüchen beschränkt. Ein individueller Löschungsantrag ist jederzeit möglich, sofern zugleich das ehemalige Bestehen einer Einwilligung bestätigt wird.</span></p><p></p><h3 id="dsg-newsletter-at">Newsletter</h3><p></p><p><span class="ts-muster-content">Mit den nachfolgenden Hinweisen informieren wir Sie über die Inhalte unseres Newsletters sowie das Anmelde-, Versand- und das statistische Auswertungsverfahren sowie Ihre Widerspruchsrechte auf. Indem Sie unseren Newsletter abonnieren, erklären Sie sich mit dem Empfang und den beschriebenen Verfahren einverstanden.<br>
<br>
Inhalt des Newsletters: Wir versenden Newsletter, E-Mails und weitere elektronische Benachrichtigungen mit werblichen Informationen (nachfolgend „Newsletter“) nur mit der Einwilligung der Empfänger oder einer gesetzlichen Erlaubnis. Sofern im Rahmen einer Anmeldung zum Newsletter dessen Inhalte konkret umschrieben werden, sind sie für die Einwilligung der Nutzer maßgeblich. Im Übrigen enthalten unsere Newsletter Informationen zu unseren Produkten und sie begleitenden Informationen (z.B. Sicherheitshinweise), Angeboten, Aktionen und unser Unternehmen.<br>
<br>
Double-Opt-In und Protokollierung: Die Anmeldung zu unserem Newsletter erfolgt in einem sog. Double-Opt-In-Verfahren. D.h. Sie erhalten nach der Anmeldung eine E-Mail, in der Sie um die Bestätigung Ihrer Anmeldung gebeten werden. Diese Bestätigung ist notwendig, damit sich niemand mit fremden E-Mailadressen anmelden kann. Die Anmeldungen zum Newsletter werden protokolliert, um den Anmeldeprozess entsprechend den rechtlichen Anforderungen nachweisen zu können. Hierzu gehört die Speicherung des Anmelde- und des Bestätigungszeitpunkts, als auch der IP-Adresse. Ebenso werden die Änderungen Ihrer bei dem Versanddienstleister gespeicherten Daten protokolliert.<br>
<br>
Anmeldedaten: Um sich für den Newsletter anzumelden, reicht es aus, wenn Sie Ihre E-Mailadresse angeben. Optional bitten wir Sie einen Namen, zwecks persönlicher Ansprache im Newsletters anzugeben.<br>
<br>
Der Versand des Newsletters und die mit ihm verbundene Erfolgsmessung erfolgen auf Grundlage einer Einwilligung der Empfänger gem. Art. 6 Abs. 1 lit. a, Art. 7 DSGVO i.V.m § 107 Abs. 2 TKG oder falls eine Einwilligung nicht erforderlich ist, auf Grundlage unserer berechtigten Interessen am Direktmarketing gem. Art. 6 Abs. 1 lt. f. DSGVO i.V.m. § 107 Abs. 2 u. 3 TKG.<br>
<br>
Die Protokollierung des Anmeldeverfahrens erfolgt auf Grundlage unserer berechtigten Interessen gem. Art. 6 Abs. 1 lit. f DSGVO. Unser Interesse richtet sich auf den Einsatz eines nutzerfreundlichen sowie sicheren Newslettersystems, das sowohl unseren geschäftlichen Interessen dient, als auch den Erwartungen der Nutzer entspricht und uns ferner den Nachweis von Einwilligungen erlaubt.<br>
<br>
Kündigung/Widerruf - Sie können den Empfang unseres Newsletters jederzeit kündigen, d.h. Ihre Einwilligungen widerrufen. Einen Link zur Kündigung des Newsletters finden Sie am Ende eines jeden Newsletters. Wir können die ausgetragenen E-Mailadressen bis zu drei Jahren auf Grundlage unserer berechtigten Interessen speichern bevor wir sie löschen, um eine ehemals gegebene Einwilligung nachweisen zu können. Die Verarbeitung dieser Daten wird auf den Zweck einer möglichen Abwehr von Ansprüchen beschränkt. Ein individueller Löschungsantrag ist jederzeit möglich, sofern zugleich das ehemalige Bestehen einer Einwilligung bestätigt wird.<br>
<br>
</span></p><p></p><h3 id="dsg-socialmedia">Onlinepräsenzen in sozialen Medien</h3><p></p><p><span class="ts-muster-content">Wir unterhalten Onlinepräsenzen innerhalb sozialer Netzwerke und Plattformen, um mit den dort aktiven Kunden, Interessenten und Nutzern kommunizieren und sie dort über unsere Leistungen informieren zu können.<br>
<br>
Wir weisen darauf hin, dass dabei Daten der Nutzer außerhalb des Raumes der Europäischen Union verarbeitet werden können. Hierdurch können sich für die Nutzer Risiken ergeben, weil so z.B. die Durchsetzung der Rechte der Nutzer erschwert werden könnte. Im Hinblick auf US-Anbieter die unter dem Privacy-Shield zertifiziert sind, weisen wir darauf hin, dass sie sich damit verpflichten, die Datenschutzstandards der EU einzuhalten.<br>
<br>
Ferner werden die Daten der Nutzer im Regelfall für Marktforschungs- und Werbezwecke verarbeitet. So können z.B. aus dem Nutzungsverhalten und sich daraus ergebenden Interessen der Nutzer Nutzungsprofile erstellt werden. Die Nutzungsprofile können wiederum verwendet werden, um z.B. Werbeanzeigen innerhalb und außerhalb der Plattformen zu schalten, die mutmaßlich den Interessen der Nutzer entsprechen. Zu diesen Zwecken werden im Regelfall Cookies auf den Rechnern der Nutzer gespeichert, in denen das Nutzungsverhalten und die Interessen der Nutzer gespeichert werden. Ferner können in den Nutzungsprofilen auch Daten unabhängig der von den Nutzern verwendeten Geräte gespeichert werden (insbesondere wenn die Nutzer Mitglieder der jeweiligen Plattformen sind und bei diesen eingeloggt sind).<br>
<br>
Die Verarbeitung der personenbezogenen Daten der Nutzer erfolgt auf Grundlage unserer berechtigten Interessen an einer effektiven Information der Nutzer und Kommunikation mit den Nutzern gem. Art. 6 Abs. 1 lit. f. DSGVO. Falls die Nutzer von den jeweiligen Anbietern der Plattformen um eine Einwilligung in die vorbeschriebene Datenverarbeitung gebeten werden, ist die Rechtsgrundlage der Verarbeitung Art. 6 Abs. 1 lit. a., Art. 7 DSGVO.<br>
<br>
Für eine detaillierte Darstellung der jeweiligen Verarbeitungen und der Widerspruchsmöglichkeiten (Opt-Out), verweisen wir auf die nachfolgend verlinkten Angaben der Anbieter.<br>
<br>
Auch im Fall von Auskunftsanfragen und der Geltendmachung von Nutzerrechten, weisen wir darauf hin, dass diese am effektivsten bei den Anbietern geltend gemacht werden können. Nur die Anbieter haben jeweils Zugriff auf die Daten der Nutzer und können direkt entsprechende Maßnahmen ergreifen und Auskünfte geben. Sollten Sie dennoch Hilfe benötigen, dann können Sie sich an uns wenden.<br>
<br>
- Facebook, -Seiten, -Gruppen, (Facebook Ireland Ltd., 4 Grand Canal Square, Grand Canal Harbour, Dublin 2, Irland) auf Grundlage einer <a target="_blank" href="https://www.facebook.com/legal/terms/page_controller_addendum">Vereinbarung über gemeinsame Verarbeitung personenbezogener Daten</a> - Datenschutzerklärung: <a target="_blank" href="https://www.facebook.com/about/privacy/">https://www.facebook.com/about/privacy/</a>, speziell für Seiten: <a target="_blank" href="https://www.facebook.com/legal/terms/information_about_page_insights_data">https://www.facebook.com/legal/terms/information_about_page_insights_data</a> , Opt-Out: <a target="_blank" href="https://www.facebook.com/settings?tab=ads">https://www.facebook.com/settings?tab=ads</a> und <a target="_blank" href="http://www.youronlinechoices.com">http://www.youronlinechoices.com</a>, Privacy Shield: <a target="_blank" href="https://www.privacyshield.gov/participant?id=a2zt0000000GnywAAC&status=Active">https://www.privacyshield.gov/participant?id=a2zt0000000GnywAAC&status=Active</a>.<br>
<br>
- Google/ YouTube (Google Ireland Limited, Gordon House, Barrow Street, Dublin 4, Irland) – Datenschutzerklärung:  <a target="_blank" href="https://policies.google.com/privacy">https://policies.google.com/privacy</a>, Opt-Out: <a target="_blank" href="https://adssettings.google.com/authenticated">https://adssettings.google.com/authenticated</a>, Privacy Shield: <a target="_blank" href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&status=Active">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&status=Active</a>.<br>
<br>
- Instagram (Instagram Inc., 1601 Willow Road, Menlo Park, CA, 94025, USA) – Datenschutzerklärung/ Opt-Out: <a target="_blank" href="http://instagram.com/about/legal/privacy/">http://instagram.com/about/legal/privacy/</a>.<br>
<br>
- Twitter (Twitter Inc., 1355 Market Street, Suite 900, San Francisco, CA 94103, USA) - Datenschutzerklärung: <a target="_blank" href="https://twitter.com/de/privacy">https://twitter.com/de/privacy</a>, Opt-Out: <a target="_blank" href="https://twitter.com/personalization">https://twitter.com/personalization</a>, Privacy Shield: <a target="_blank" href="https://www.privacyshield.gov/participant?id=a2zt0000000TORzAAO&status=Active">https://www.privacyshield.gov/participant?id=a2zt0000000TORzAAO&status=Active</a>.<br>
<br>
- Pinterest (Pinterest Inc., 635 High Street, Palo Alto, CA, 94301, USA) – Datenschutzerklärung/ Opt-Out: <a target="_blank" href="https://about.pinterest.com/de/privacy-policy">https://about.pinterest.com/de/privacy-policy</a>.<br>
<br>
- LinkedIn (LinkedIn Ireland Unlimited Company Wilton Place, Dublin 2, Irland) - Datenschutzerklärung <a target="_blank" href="https://www.linkedin.com/legal/privacy-policy">https://www.linkedin.com/legal/privacy-policy</a> , Opt-Out: <a target="_blank" href="https://www.linkedin.com/psettings/guest-controls/retargeting-opt-out">https://www.linkedin.com/psettings/guest-controls/retargeting-opt-out</a>, Privacy Shield: <a target="_blank" href="https://www.privacyshield.gov/participant?id=a2zt0000000L0UZAA0&status=Active">https://www.privacyshield.gov/participant?id=a2zt0000000L0UZAA0&status=Active</a>.<br>
<br>
- Xing (XING AG, Dammtorstraße 29-32, 20354 Hamburg, Deutschland) - Datenschutzerklärung/ Opt-Out: <a target="_blank" href="https://privacy.xing.com/de/datenschutzerklaerung">https://privacy.xing.com/de/datenschutzerklaerung</a>.<br>
<br>
- Wakalet (Wakelet Limited, 76 Quay Street, Manchester, M3 4PR, United Kingdom) - Datenschutzerklärung/ Opt-Out: <a target="_blank" href="https://wakelet.com/privacy.html">https://wakelet.com/privacy.html</a>.<br>
<br>
- Soundcloud (SoundCloud Limited, Rheinsberger Str. 76/77, 10115 Berlin, Deutschland) - Datenschutzerklärung/ Opt-Out: <a target="_blank" href="https://soundcloud.com/pages/privacy">https://soundcloud.com/pages/privacy</a>.</span></p><p></p><h3 id="dsg-thirdparty-einleitung">Einbindung von Diensten und Inhalten Dritter</h3><p></p><p><span class="ts-muster-content">Wir setzen innerhalb unseres Onlineangebotes auf Grundlage unserer berechtigten Interessen (d.h. Interesse an der Analyse, Optimierung und wirtschaftlichem Betrieb unseres Onlineangebotes im Sinne des Art. 6 Abs. 1 lit. f. DSGVO) Inhalts- oder Serviceangebote von Drittanbietern ein, um deren Inhalte und Services, wie z.B. Videos oder Schriftarten einzubinden (nachfolgend einheitlich bezeichnet als “Inhalte”). <br>
<br>
Dies setzt immer voraus, dass die Drittanbieter dieser Inhalte, die IP-Adresse der Nutzer wahrnehmen, da sie ohne die IP-Adresse die Inhalte nicht an deren Browser senden könnten. Die IP-Adresse ist damit für die Darstellung dieser Inhalte erforderlich. Wir bemühen uns nur solche Inhalte zu verwenden, deren jeweilige Anbieter die IP-Adresse lediglich zur Auslieferung der Inhalte verwenden. Drittanbieter können ferner so genannte Pixel-Tags (unsichtbare Grafiken, auch als "Web Beacons" bezeichnet) für statistische oder Marketingzwecke verwenden. Durch die "Pixel-Tags" können Informationen, wie der Besucherverkehr auf den Seiten dieser Website ausgewertet werden. Die pseudonymen Informationen können ferner in Cookies auf dem Gerät der Nutzer gespeichert werden und unter anderem technische Informationen zum Browser und Betriebssystem, verweisende Webseiten, Besuchszeit sowie weitere Angaben zur Nutzung unseres Onlineangebotes enthalten, als auch mit solchen Informationen aus anderen Quellen verbunden werden.</span></p><p></p><h3 id="dsg-thirdparty-vimeo">Vimeo</h3><p></p><p><span class="ts-muster-content">Wir können die Videos der Plattform “Vimeo” des Anbieters Vimeo Inc., Attention: Legal Department, 555 West 18th Street New York, New York 10011, USA, einbinden. Datenschutzerklärung: <a target="_blank" href="https://vimeo.com/privacy">https://vimeo.com/privacy</a>.  Wir weisen darauf hin, dass Vimeo Google Analytics einsetzen kann und verweisen hierzu auf die Datenschutzerklärung (<a target="_blank" href="https://policies.google.com/privacy">https://policies.google.com/privacy</a>) sowie Opt-Out-Möglichkeiten für Google-Analytics (<a target="_blank" href="http://tools.google.com/dlpage/gaoptout?hl=de">http://tools.google.com/dlpage/gaoptout?hl=de</a>) oder die Einstellungen von Google für die Datennutzung zu Marketingzwecken (<a target="_blank" href="https://adssettings.google.com/">https://adssettings.google.com/</a>).</span></p><p></p><h3 id="dsg-thirdparty-youtube">Youtube</h3><p></p><p><span class="ts-muster-content">Wir binden die Videos der Plattform “YouTube” des Anbieters Google Ireland Limited, Gordon House, Barrow Street, Dublin 4, Irland, ein. Datenschutzerklärung: <a target="_blank" href="https://www.google.com/policies/privacy/">https://www.google.com/policies/privacy/</a>, Opt-Out: <a target="_blank" href="https://adssettings.google.com/authenticated">https://adssettings.google.com/authenticated</a>.</span></p><p></p><h3 id="dsg-thirdparty-googlefonts">Google Fonts</h3><p></p><p><span class="ts-muster-content">Wir binden die Schriftarten ("Google Fonts") des Anbieters Google Ireland Limited, Gordon House, Barrow Street, Dublin 4, Irland, ein. Nach Angaben von Google werden die Daten der Nutzer allein zu Zwecken der Darstellung der Schriftarten im Browser der Nutzer verwendet. Die Einbindung erfolgt auf Grundlage unserer berechtigten Interessen an einer technisch sicheren, wartungsfreien und effizienten Nutzung von Schriftarten, deren einheitlicher Darstellung sowie Berücksichtigung möglicher lizenzrechtlicher Restriktionen für deren Einbindung. Datenschutzerklärung: <a target="_blank" href="https://www.google.com/policies/privacy/">https://www.google.com/policies/privacy/</a>.</span></p><p></p><h3 id="dsg-thirdparty-googlerecaptcha">Google ReCaptcha</h3><p></p><p><span class="ts-muster-content">Wir binden die Funktion zur Erkennung von Bots, z.B. bei Eingaben in Onlineformularen ("ReCaptcha") des Anbieters GGoogle Ireland Limited, Gordon House, Barrow Street, Dublin 4, Irland, ein. Datenschutzerklärung: <a target="_blank" href="https://www.google.com/policies/privacy/">https://www.google.com/policies/privacy/</a>, Opt-Out: <a target="_blank" href="https://adssettings.google.com/authenticated">https://adssettings.google.com/authenticated</a>.</span></p><p></p><h3 id="dsg-thirdparty-googlemaps">Google Maps</h3><p></p><p><span class="ts-muster-content">Wir binden die Landkarten des Dienstes “Google Maps” des Anbieters Google Ireland Limited, Gordon House, Barrow Street, Dublin 4, Irland, ein. Zu den verarbeiteten Daten können insbesondere IP-Adressen und Standortdaten der Nutzer gehören, die jedoch nicht ohne deren Einwilligung (im Regelfall im Rahmen der Einstellungen ihrer Mobilgeräte vollzogen), erhoben werden. Die Daten können in den USA verarbeitet werden. Datenschutzerklärung: <a target="_blank" href="https://www.google.com/policies/privacy/">https://www.google.com/policies/privacy/</a>, Opt-Out: <a target="_blank" href="https://adssettings.google.com/authenticated">https://adssettings.google.com/authenticated</a>.</span></p><p></p><h3 id="dsg-facebook-plugin">Verwendung von Facebook Social Plugins</h3><p></p><p><span class="ts-muster-content">Wir nutzen auf Grundlage unserer berechtigten Interessen (d.h. Interesse an der Analyse, Optimierung und wirtschaftlichem Betrieb unseres Onlineangebotes im Sinne des Art. 6 Abs. 1 lit. f. DSGVO) Social Plugins ("Plugins") des sozialen Netzwerkes facebook.com, welches von der Facebook Ireland Ltd., 4 Grand Canal Square, Grand Canal Harbour, Dublin 2, Irland betrieben wird ("Facebook"). <br>
Hierzu können z.B. Inhalte wie Bilder, Videos oder Texte und Schaltflächen gehören, mit denen Nutzer Inhalte dieses Onlineangebotes innerhalb von Facebook teilen können. Die Liste und das Aussehen der Facebook Social Plugins kann hier eingesehen werden: <a target="_blank" href="https://developers.facebook.com/docs/plugins/">https://developers.facebook.com/docs/plugins/</a>.<br>
<br>
Facebook ist unter dem Privacy-Shield-Abkommen zertifiziert und bietet hierdurch eine Garantie, das europäische Datenschutzrecht einzuhalten (<a target="_blank" href="https://www.privacyshield.gov/participant?id=a2zt0000000GnywAAC&status=Active">https://www.privacyshield.gov/participant?id=a2zt0000000GnywAAC&status=Active</a>).<br>
<br>
Wenn ein Nutzer eine Funktion dieses Onlineangebotes aufruft, die ein solches Plugin enthält, baut sein Gerät eine direkte Verbindung mit den Servern von Facebook auf. Der Inhalt des Plugins wird von Facebook direkt an das Gerät des Nutzers übermittelt und von diesem in das Onlineangebot eingebunden. Dabei können aus den verarbeiteten Daten Nutzungsprofile der Nutzer erstellt werden. Wir haben daher keinen Einfluss auf den Umfang der Daten, die Facebook mit Hilfe dieses Plugins erhebt und informiert die Nutzer daher entsprechend unserem Kenntnisstand.<br>
<br>
Durch die Einbindung der Plugins erhält Facebook die Information, dass ein Nutzer die entsprechende Seite des Onlineangebotes aufgerufen hat. Ist der Nutzer bei Facebook eingeloggt, kann Facebook den Besuch seinem Facebook-Konto zuordnen. Wenn Nutzer mit den Plugins interagieren, zum Beispiel den Like Button betätigen oder einen Kommentar abgeben, wird die entsprechende Information von Ihrem Gerät direkt an Facebook übermittelt und dort gespeichert. Falls ein Nutzer kein Mitglied von Facebook ist, besteht trotzdem die Möglichkeit, dass Facebook seine IP-Adresse in Erfahrung bringt und speichert. Laut Facebook wird in Deutschland nur eine anonymisierte IP-Adresse gespeichert.<br>
<br>
Zweck und Umfang der Datenerhebung und die weitere Verarbeitung und Nutzung der Daten durch Facebook sowie die diesbezüglichen Rechte und Einstellungsmöglichkeiten zum Schutz der Privatsphäre der Nutzer, können diese den Datenschutzhinweisen von Facebook entnehmen: <a target="_blank" href="https://www.facebook.com/about/privacy/">https://www.facebook.com/about/privacy/</a>.<br>
<br>
Wenn ein Nutzer Facebookmitglied ist und nicht möchte, dass Facebook über dieses Onlineangebot Daten über ihn sammelt und mit seinen bei Facebook gespeicherten Mitgliedsdaten verknüpft, muss er sich vor der Nutzung unseres Onlineangebotes bei Facebook ausloggen und seine Cookies löschen. Weitere Einstellungen und Widersprüche zur Nutzung von Daten für Werbezwecke, sind innerhalb der Facebook-Profileinstellungen möglich: <a target="_blank" href="https://www.facebook.com/settings?tab=ads">https://www.facebook.com/settings?tab=ads</a>  oder über die US-amerikanische Seite <a target="_blank" href="http://www.aboutads.info/choices/">http://www.aboutads.info/choices/</a>  oder die EU-Seite <a target="_blank" href="http://www.youronlinechoices.com/">http://www.youronlinechoices.com/</a>. Die Einstellungen erfolgen plattformunabhängig, d.h. sie werden für alle Geräte, wie Desktopcomputer oder mobile Geräte übernommen.</span></p><p></p><h3 id="dsg-thirdparty-twitter">Twitter</h3><p></p><p><span class="ts-muster-content">Innerhalb unseres Onlineangebotes können Funktionen und Inhalte des Dienstes Twitter, angeboten durch die Twitter Inc., 1355 Market Street, Suite 900, San Francisco, CA 94103, USA, eingebunden werden. Hierzu können z.B. Inhalte wie Bilder, Videos oder Texte und Schaltflächen gehören, mit denen Nutzer Inhalte dieses Onlineangebotes innerhalb von Twitter teilen können.<br>
Sofern die Nutzer Mitglieder der Plattform Twitter sind, kann Twitter den Aufruf der o.g. Inhalte und Funktionen den dortigen Profilen der Nutzer zuordnen. Twitter ist unter dem Privacy-Shield-Abkommen zertifiziert und bietet hierdurch eine Garantie, das europäische Datenschutzrecht einzuhalten (<a target="_blank" href="https://www.privacyshield.gov/participant?id=a2zt0000000TORzAAO&status=Active">https://www.privacyshield.gov/participant?id=a2zt0000000TORzAAO&status=Active</a>). Datenschutzerklärung: <a target="_blank" href="https://twitter.com/de/privacy">https://twitter.com/de/privacy</a>, Opt-Out: <a target="_blank" href="https://twitter.com/personalization">https://twitter.com/personalization</a>.</span></p><a href="https://datenschutz-generator.de" class="dsg1-6" rel="nofollow" target="_blank">Erstellt mit Datenschutz-Generator.de von RA Dr. Thomas Schwenke</a>                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title float-left"><?= $_LANG['PERSONAL_INFO'] ?></h4>
                        </div>
                        <div class="card-body">
                            <h4><?= $user->name ?></h4>
                            <p><?= ($user->addr_street !== null && $user->addr_number !== null)? $user->addr_street.' '.$user->addr_number : '' ?></p>
                            <p><?= ($user->addr_country !== null && $user->addr_plz !== null)? $user->addr_plz.' '.$user->addr_city : '' ?></p>
                            <p><?= ($user->addr_city !== null)? $user->addr_country : '' ?></p>
                            <p><?= $user->email ?></p>
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title float-left">Statistiken</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            // eheren Config
                            try{
                                $pdo = \smnbots\Database::getDB();
                                $botsql = 'SELECT * FROM `bots`';
                                $botstmt = $pdo->prepare($botsql);
                                $botstmt->execute();
								$bots = $botstmt->rowCount();
                                //$bots = $botstmt->fetch()['id'];

                                $usersql = 'SELECT id FROM `users` ORDER by id DESC LIMIT 1';
                                $userstmt = $pdo->prepare($usersql);
                                $userstmt->execute();
                                $users = $userstmt->fetch()['id'];
                            } catch (PDOException $e){
                                error_log($e->getMessage());
                            }
                            ?>

                            <p><b><?= round($users); ?></b> Registrierungen</p>
                            <p><b><?= round($bots); ?></b> Musikbots</p>
                            <p><b><?= count(\smnbots\Config::nodes) ?></b> Nodes</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php include 'assets/footer.php'?>
    </div>
</div>

<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<?= \smnbots\translation::getJS(); ?>
<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="assets/js/plugins/sweetalert2.min.js"></script>
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<script src="assets/js/black-dashboard.min.js?v=1.0.0"></script>
<script src="assets/js/smnbots.js"></script>
<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
<?php if (isset($_SESSION['error'])){ ?>
    <script>
        smnswal({
            title: '<?= $_SESSION['error'][0] ?>',
            html: '<?= $_SESSION['error'][1] ?>',
            type: "error",
            timer: 1500,
        })
    </script>
    <?php unset($_SESSION['error']);
} ?>
</body>

</html>
