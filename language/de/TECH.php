<?php

/**
 _  \_/ |\ | /¯¯\ \  / /\    |¯¯) |_¯ \  / /¯¯\ |  |   |´¯|¯` | /¯¯\ |\ |5
 ¯  /¯\ | \| \__/  \/ /--\   |¯¯\ |__  \/  \__/ |__ \_/   |   | \__/ | \|Core.
 * @author: Copyright (C) 2011 by Brayan Narvaez (Prinick) developer of xNova Revolution
 * @link: http://www.xnovarevolution.con.ar

 * @package 2Moons
 * @author Slaver <slaver7@gmail.com>
 * @copyright 2009 Lucky <douglas@crockford.com> (XGProyecto)
 * @copyright 2011 Slaver <slaver7@gmail.com> (Fork/2Moons)
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.3 (2011-01-21)
 * @link http://code.google.com/p/2moons/

 * Please do not remove the credits
*/

//SHORT NAMES FOR COMBAT REPORTS
$LNG['tech_rc'] = array (
202 => 'Kleiner Transporter',
203 => 'Großer Transporter',
204 => 'Leichter Jäger',
205 => 'Schwerer Jäger',
206 => 'Kreuzer',
207 => 'Schlachtschiff',
208 => 'Kolonieschiff',
209 => 'Recycler',
210 => 'Spionagesonde',
211 => 'Bomber',
212 => 'Solarsatellit',
213 => 'Zerstörer',
214 => 'Todesstern',
215 => 'Schlachtkreuzer',
216 => 'Lune Noire',
217 => 'Evo. Transporter',
218 => 'Avatar',
219 => 'Gigarecycler',
220 => 'Inter. DM-Sammler',

401 => 'Raketenwerfer',
402 => 'Leichtes Lasergeschütz',
403 => 'Schweres Lasergeschütz',
404 => 'Gaußkanone',
405 => 'Ionengeschütz',
406 => 'Plasmawerfer',
407 => 'Kleine Schildkuppel',
408 => 'Große Schildkuppel',
409 => 'Gigantische Schildkuppel',
410 => 'Gravitonenkanone',
411 => 'Orbitale Verteidigungsplattform',
);



$LNG['tech'] = array(
  0 => 'Konstruktionen',
  1 => 'Metallmine',
  2 => 'Kristallmine',
  3 => 'Deuteriumsynthetisierer',
  4 => 'Solarkraftwerk',
  6 => 'TechnoDome',
  7 => 'Noriummine',
 12 => 'Atomkraftwerk',
 14 => 'Roboterfabrik',
 15 => 'Nanitenfabrik',
 21 => 'Raumschiffwerft',
 22 => 'Metallspeicher',
 23 => 'Kristallspeicher',
 24 => 'Deuteriumtank',
 25 => 'Noriumtank',
 31 => 'Forschungslabor',
 33 => 'Terraformer',
 34 => 'Allianzdepot',
 44 => 'Raketensilo',


 40 => 'Mondgebäude',
 41 => 'Basisstützpunkt',
 42 => 'Sensorenphalax',
 43 => 'Sprungtor',
// Technologies
100 => 'Forschungen',
106 => 'Spionagetechnik',
108 => 'Computertechnik',
109 => 'Waffentechnik',
110 => 'Schildtechnik',
111 => 'Raumschiffpanzerung',
113 => 'Energietechnik',
114 => 'Hyperraumtechnik',
115 => 'Verbrennungstriebwerk',
117 => 'Impulstriebwerk',
118 => 'Hyperraumantrieb',
120 => 'Lasertechnik',
121 => 'Ionentechnik',
122 => 'Plasmatechnik',
123 => 'Intergalaktisches Forschungsnetzwerk',
124 => 'Astrophysik',
131 => 'Produktionsmaximierung Metall',
132 => 'Produktionsmaximierung Kristall',
133 => 'Produktionsmaximierung Deuterium',
134 => 'Entfernung von Dunkler Materie',
199 => 'Gravitonforschung',

200 => 'Schiffe',
202 => 'Kleiner Transporter',
203 => 'Großer Transporter',
204 => 'Leichter Jäger',
205 => 'Schwerer Jäger',
206 => 'Kreuzer',
207 => 'Schlachtschiff',
208 => 'Kolonieschiff',
209 => 'Recycler',
210 => 'Spionagesonde',
211 => 'Bomber',
212 => 'Solarsatellit',
213 => 'Zerstörer',
214 => 'Todesstern',
215 => 'Schlachtkreuzer',
216 => 'Lune Noire',
217 => 'Evolution Transporter',
218 => 'Avatar',
219 => 'Gigarecycler',
220 => 'Intergalaktischer D. Materiensammler',

400 => 'Verteidigungsanlagen',
401 => 'Raketenwerfer',
402 => 'Leichtes Lasergeschütz',
403 => 'Schweres Lasergeschütz',
404 => 'Gaußkanone',
405 => 'Ionengeschütz',
406 => 'Plasmawerfer',
407 => 'Kleine Schildkuppel',
408 => 'Große Schildkuppel',
409 => 'Gigantische Schildkuppel',
410 => 'Gravitonkanone',
411 => 'Orbitale Verteidigungsplattform',

502 => 'Abfangrakete',
503 => 'Interplanetarrakete',

700 => 'Admiral',
701 => 'Battle Engineer',
702 => 'Koordinator',
703 => 'Geologe',
704 => 'Lokale Enginer',
705 => 'Technokrat',
706 => 'Allgemeine',
);

$LNG['res']['descriptions'] = array(
1 => 'Hauptrohstofflieferanten für den Bau tragender Strukturen von Bauwerken und Schiffen.',
2 => 'Hauptrohstofflieferanten für elektronische Bauteile und Legierungen.',
3 => 'Entziehen dem Wasser eines Planeten den geringen Deuteriumanteil.',
4 => 'Solarkraftwerke gewinnen Energie aus Sonneneinstrahlung. Einige Gebäude benötigen Energie für ihren Betrieb.',
6 => 'Sie verkürzt pro Stufe die Forschungszeit um 8%.',
7 => 'Nori vor kurzem entdeckt wurde, ist ein Mineral, das aus der Fusion von Metall mit Glas geboren wurde, ist derzeit verwendet, um Schiffe als Schutzschilde Norio gebaut haben viel widerstandsfähiger als herkömmliche Metall-Schilde, Nori erwiesen bauen hat ein Bild ähnlich wie Glas, so kann man durch sie sehen, mit den Ingenieuren wertvolle Ressource finden Sie eine neue Mine haben es geschafft, aus den Tiefen des Planeten zu extrahieren, ist eine Ressource, die in der Nähe der Kern des Planeten ist.',
12 => 'Das Atomkraftwerk gewinnt Energie aus Brennstäben die aus Deuterium gefertigt werden.',
14 => 'Roboterfabriken stellen einfache Arbeitskräfte zur Verfügung, die beim Bau der planetaren Infrastruktur eingesetzt werden. Jede Stufe erhöht damit die Geschwindigkeit des Ausbaus von Gebäuden.',
15 => 'Stellt die Krönung der Robotertechnik dar. Jede Stufe halbiert die Bauzeit von Gebäuden, Schiffen und Verteidigung.',
21 => 'In der planetaren Werft werden alle Arten von Schiffen und Verteidigungsanlagen gebaut.',
22 => 'Lagerstätte für unbearbeitete Metallerze bevor sie weiter verarbeitet werden.',
23 => 'Lagerstätte für unbearbeitetes Kristall bevor es weiter verarbeitet wird.',
24 => 'Riesige Tanks zur Lagerung des neu gewonnenen Deuteriums.',
25 => 'Lagerstätte für unbearbeitete Norium bevor sie weiter verarbeitet werden.',
31 => 'Um neue Technologien zu erforschen, ist der Betrieb einer Forschungsstation notwendig.',
33 => 'Der Terraformer vergrössert die nutzbare Fläche auf Planeten.',
34 => 'Das Allianzdepot bietet die Möglichkeit, befreundete Flotten, die bei der Verteidigung helfen und im Orbit stehen, mit Treibstoff zu versorgen.',
41 => 'Ein Mond verfügt über keinerlei Atmosphäre, deshalb muss vor der Besiedlung eine Mondbasis errichtet werden.',
42 => 'Die Sensorphalanx erlaubt es, Flottenbewegungen zu beobachten. Je höher die Ausbaustufe, desto grösser ist die Reichweite der Phalanx.',
43 => 'Sprungtore sind riesige Transmitter, die in der Lage sind, selbst riesige Flotten ohne Zeitverlust durch das Universum zu versenden.',
44 => 'Raketensilos dienen zum Einlagern von Raketen.',

106 => 'Mit Hilfe dieser Technik lassen sich Informationen über andere Planeten und Monde gewinnen.',
108 => 'Mit der Erhöhung der Computerkapazitäten lassen sich immer mehr Flotten befehligen. Jede Stufe Computertechnik erhöht dabei die maximale Flottenanzahl um eins.',
109 => 'Waffentechnik macht Waffensysteme effizienter. Jede Stufe der Waffentechnik erhöht die Waffenstärke der Einheiten um 10% des Grundwertes.',
110 => 'Schildtechnik macht die Schilde der Schiffe und Verteidigungsanlagen effizienter. Jede Stufe der Schildtechnik steigert die Effizienz der Schilde um 10% des Grundwertes.',
111 => 'Spezielle Legierungen machen die Panzerung der Raumschiffe immer besser. Die Wirksamkeit der Panzerung kann so pro Stufe um 10% gesteigert werden.',
113 => 'Die Beherrschung der unterschiedlichen Arten von Energie ist für viele neue Technologien notwendig.',
114 => 'Durch die Einbindung der 4. und 5. Dimension ist es nun möglich einen neuartigen Antrieb zu erforschen, welcher sparsamer und leistungsfähiger ist.',
115 => 'Die Weiterentwicklung dieser Triebwerke macht einige Schiffe schneller, allerdings steigert jede Stufe die Geschwindigkeit nur um 10% des Grundwertes.',
117 => 'Das Impulstriebwerk basiert auf dem Rükstossprinzip. Die Weiterentwicklung dieser Triebwerke macht einige Schiffe schneller, allerdings steigert jede Stufe die Geschwindigkeit nur um 20% des Grundwertes.',
118 => 'Krümmt den Raum um ein Schiff. Die Weiterentwicklung dieser Triebwerke macht einige Schiffe schneller, allerdings steigert jede Stufe die Geschwindigkeit nur um 30% des Grundwertes.',
120 => 'Durch Bündelung des Lichtes entsteht ein Strahl der beim Auftreffen auf ein Objekt Schaden anrichtet.',
121 => 'Wahrhaft tödlicher Richtstrahl aus beschleunigten Ionen. Diese richten beim Auftreffen auf ein Objekt einen riesigen Schaden an.',
122 => 'Eine Weiterentwicklung der Ionentechnik, die nicht Ionen beschleunigt, sondern hochenergetisches Plasma. Dieses hat eine verheerende Wirkung beim Auftreffen auf ein Objekt.',
123 => 'Forscher verschiedener Planeten kommunizieren über dieses Netzwerk miteinander. Durch das Zusammenschalten der Labore wird die Forschungszeit verkürzt, jede Stufe schaltet die Labore eines Planeten dazu.',
124 => 'Weitere Erkenntnisse in der Astrophysik ermöglichen den Bau von Laboren, mit denen immer mehr Schiffe ausgestattet werden können. Dadurch werden weite Expeditionsreisen in noch unerforschte Gebiete möglich. Zudem erlauben die Fortschritte die weitere Kolonisation des Weltraumes. Pro zwei Stufen dieser Technologie kann so ein weiterer Planet nutzbar gemacht werden.',
131 => 'Erhöht die Produktion der Metallmine um 2%',
132 => 'Erhöht die Produktion der Kristallmine um 2%',
133 => 'Erhöht die Produktion der Deuteriumsynthetisierer um 2%',
134 => 'Dunkle Materie ist eine Ressource, zu teuer, und wer sie besitzt in großen Mengen wird ein Millionär werden. Die Extraktion Technik der Dunklen Materie wurde von führenden Wissenschaftlern des Reiches, durch ein Technokrat begleitet den letzten Punkt zu erreichen, die eine Methode zur Extraktion von dunkler Materie im Mond Porfin erhalten untersucht.',
199 => 'Durch Abschuss einer konzentrierten Ladung von Gravitonpartikeln kann ein künstliches Gravitationsfeld errichtet werden, wodurch Schiffe oder auch Monde vernichtet werden können.',

202 => 'Der kleine Transporter ist ein wendiges Schiff, welches Rohstoffe schnell zu anderen Planeten transportieren kann.',
203 => 'Die Weiterentwicklung des kleinen Transporters hat ein grösseres Ladevermögen und kann sich dank weiterentwickeltem Antrieb noch schneller fortbewegen als der kleine Transporter.',
204 => 'Der leichte Jäger ist ein wendiges Schiff, das auf fast jedem Planeten vorgefunden wird. Die Kosten sind nicht besonders hoch, Schildstärke und Ladekapazität sind allerdings sehr gering.',
205 => 'Die Weiterentwicklung des leichten Jägers ist besser gepanzert und hat eine höhere Angriffsstärke.',
206 => 'Kreuzer sind fast dreimal so stark gepanzert wie schwere Jäger und verfügen über mehr als die doppelte Schusskraft. Zudem sind sie sehr schnell.',
207 => 'Schlachtschiffe bilden meist das Rückgrat einer Flotte. Ihre schweren Geschütze, die hohe Geschwindigkeit und der große Frachtraum machen sie zu ernst zu nehmenden Gegnern.',
208 => 'Fremde Planeten können mit diesem Schiff kolonisiert werden.',
209 => 'Mit dem Recycler lassen sich Rohstoffe aus Trümmerfeldern gewinnen.',
210 => 'Spionagesonden sind kleine wendige Drohnen, welche über weite Entfernungen hinweg Daten über Flotten und Planeten liefern.',
211 => 'Der Bomber wurde extra entwickelt, um die Verteidigung eines Planeten zu zerstören.',
212 => 'Solarsatelliten sind einfache Plattformen aus Solarzellen, die sich in einem hohen stationären Orbit befinden. Sie sammeln das Sonnenlicht und geben es per Laser an die Bodenstation weiter.',
213 => 'Der Zerstörer ist der König unter den Kriegsschiffen.',
214 => 'Die Zerstörungskraft des Todessterns ist unübertroffen und er kann als einziges Schiff Monde zerstören.',
215 => 'Der Schlachtkreuzer ist auf das Abfangen feindlicher Flotten spezialisiert.',
216 => 'Der Nachfolger des beliebten Todessterns, etwas schneller und stärker.',
217 => 'Ist der eine Weiterentwicklung des gro&szlig;en Transporters. Er hat mehr Ladevermögen und fliegt schneller.',
218 => 'Der Supergau schlechthin, allerdings sehr langsam.',
219 => 'Ist eine gigantische Weltraumrecycleanlage und hyperschnell.',
220 => 'Mit diesem Schiff ist es nach jahrelangem Forschen möglich, Dunkle Materie an seinem Mond zu sammeln.',

401 => 'Der Raketenwerfer ist eine einfache aber kostengünstige Verteidigungsmöglichkeit.',
402 => 'Durch den konzentrierten Beschuss eines Ziels mit Photonen kann eine wesentlich grössere Schadenswirkung erzielt werden, als mit gewöhnlichen ballistischen Waffen.',
403 => 'Der schwere Laser stellt die konseqünte Weiterentwicklung des leichten Lasers dar.',
404 => 'Die Gaußkanone beschleunigt tonnenschwere Geschosse unter gigantischem elektrischen Aufwand.',
405 => 'Das Ionengeschütz schleudert eine Welle von Ionen auf das Ziel, welche Schilde destabilisiert und die Elektronik beschädigt.',
406 => 'Plasmageschütze setzen die Kraft einer Sonneneruption frei und übertreffen in ihrer zerstörerischen Wirkung sogar den Zerstörer.',
407 => 'Die kleine Schildkuppel umhüllt den ganzen Planeten mit einem Feld, welches ungeheure Mengen an Energie absorbieren kann.',
408 => 'Die Weiterentwicklung der Kleinen Schildkuppel kann wesentlich mehr Energie einsetzen um Angriffe abzuhalten.',
409 => 'Die Weiterentwicklung der Großen Schildkuppel ist die Krönung der Schildtechnik sie kann wesentlich mehr Energie einsetzen um Angriffe abzuhalten als alle anderen Schildkupeln.',
410 => 'Nach jahrelangen forschen an der Gravitationkraft ist es Forschern gelugen, eine Graviationkanone zu entwickeln, die kleine konzentrierte Gravitionfelder erzeugen kann und sie auf die Gegner schießen lässt.',
411 => 'Es ist eine unbewegliche defensive Plattform. Sie besitzt keinen direkten Antrieb und wird durch Gravitonforschung in einer stabilen Umlaufbahn des Planeten gehalten. Das starten dieses Vorgangs erfordert hohe Massen an Energie.',

502 => 'Abfangraketen zerstören angreifende Interplanetarraketen.',
503 => 'Interplanetarraketen zerstören die gegnerische Verteidigung.',

700 => 'Der Admiral ist ein erfahrener Veteran und ein geschickter Taktiker. In der härtesten Schlachten der Lage ist, eine Vorstellung von der Situation zu machen und an ihre Untergebenen Admiräle. Ein weiser Kaiser kann auf ihre Hilfe während der Kämpfe verlassen, um den Angriff Wert der Schiffe und Verteidigungsanlagen in %s%% erhöhen.',
701 => 'Engineer Kampf ist ein Spezialist für Energiemanagement in Zeiten des Krieges, garantiert die Lieferung von Energie an die Kanonen, die Vermeidung einer Überlastung, die zu einer Verringerung der Verteidigung in der Schlacht in verloren führt %s%%.',
702 => 'Der Koordinator ist verantwortlich für die Säuberung der Arbeit vor Ort des Reiches, in seiner Gegenwart das Gebäude Bauzeit von% s%% reduziert.',
703 => 'Der Geologe ist ein Experte in astrominerología und astrocristalografía. Unterstützt Teams in der metallurgischen und chemischen und ist auch verantwortlich für interplanetare Kommunikation zur Optimierung der Nutzung und Ausgestaltung der Rohstoff im ganzen Reich durch eine Erhöhung der Produktion von Ressourcen in %s%%.',
704 => 'Die lokalen Ingenieur ist ein especalista im Energie-Management jederzeit erhöht die Effizienz der Energie auf dem Planeten durch die Erhöhung der Energieproduktion in %s%%.',
705 => 'Die Gilde ist der Technokraten Genies zusammen, und finde ich immer, dass gefährliche Kante, wo alles in tausend Stücke explodieren vor der Feststellung technologischen und rationale Erklärung. Kein normaler Mensch würde jemals knacken Sie den Code ein Technokrat, inspiriert seine Anwesenheit Forscher Reich verringern Forschung Mal in %s%%.',
706 => 'Die Flotte ist generell zuständig für die Koordinierung der Kämpfe, das Universum als die Handfläche bekannt, in der Gegenwart der allgemeinen Ordnung in der Flotte ist anders, und dann seine Zeit zu surfen viel schneller, verkürzt die Flugzeit in %s%% auf exepcion Expeditionen.',
);


// ----------------------------------------------------------------------------------------------------------
// Minen Gebäude
$LNG['info'][1]['name']			 = 'Metallmine';
$LNG['info'][1]['description']   = 'Hauptrohstofflieferanten für den Bau tragender Strukturen von Bauwerken und Schiffen. Metall ist der billigste Rohstoff, dafür wird er mehr benötigt als die anderen. Metall braucht zur Herstellung am wenigsten Energie. Je grösser die Minen ausgebaut sind, desto tiefer sind sie. Bei den meisten Planeten befindet sich das Metall in großer Tiefe, durch diese tieferen Minen können mehr Metalle abgebaut werden, die Produktion steigt. Gleichzeitig muss für die grössere Metallmine mehr Energie zur Verfügung gestellt werden.';
$LNG['info'][2]['name']			 = 'Kristallmine';
$LNG['info'][2]['description']   = 'Baut Mineralien ab, die für die Feinelektronik benötigt werden. Sie benötigt jedoch mehr, da sie die Mineralien gleich in nötige Legierungen verarbeitet.';
$LNG['info'][3]['name']			 = 'Deuteriumsynthetisierer';
$LNG['info'][3]['description']   = 'Deuterium ist schwerer Wasserstoff. Daher sind ähnlich wie bei den Minen die grössten Vorräte auf dem Grund des Meeres. Der Ausbau des Synthetisierers sorgt ebenfalls für die Erschliessung dieser Deuterium-Tiefenlagerstätten. Deuterium wird als Treibstoff für die Schiffe, für fast alle Forschungen, für einen Blick in die Galaxie sowie für den Sensorphalanx-Scan benötigt.';
$LNG['info'][7]['name']			 = 'Noriummine';
$LNG['info'][7]['description']   = 'Nori vor kurzem entdeckt wurde, ist ein Mineral, das aus der Fusion von Metall mit Glas geboren wurde, ist derzeit verwendet, um Schiffe als Schutzschilde Norio gebaut haben viel widerstandsfähiger als herkömmliche Metall-Schilde, Nori erwiesen bauen hat ein Bild ähnlich wie Glas, so kann man durch sie sehen, mit den Ingenieuren wertvolle Ressource finden Sie eine neue Mine haben es geschafft, aus den Tiefen des Planeten zu extrahieren, ist eine Ressource, die in der Nähe der Kern des Planeten ist.';

// ----------------------------------------------------------------------------------------------------------
// Energie Gebäude
$LNG['info'][4]['name']			 = 'Solarkraftwerk';
$LNG['info'][4]['description']   = 'Um die Energie zur Versorgung der Minen und Synthetisierern zu gewährleisten, sind riesige Solarkraftwerkanlagen von Nöten. Je grösser die Anlagen ausgebaut sind, desto mehr Oberfläche ist mit photovoltaischen Zellen bedeckt, welche Lichtenergie in elektrische Energie umwandeln. Solarkraftwerke stellen den Grundstock der planetaren Energieversorgung dar.';
$LNG['info'][12]['name']		 = 'Atomkraftwerk';
$LNG['info'][12]['description']  = 'Im Atomkraftwerk werden Atome gespalten, um so mehr Energie zu erzeugen als in dem Solarkraftwerk, allerdings ist es teurer im Bau.';

// ----------------------------------------------------------------------------------------------------------
// Gebäude
$LNG['info'][6]['name']			 = 'TechoDome';
$LNG['info'][6]['description']   = 'Aufgrund der immer zeitaufwendigeren Forschungen, haben sich die klügsten Köpfe der intergalaktischen Forschungsnetzwerke zusammengetan und den TechnoDome entwickelt. Es verkürzt die Forschungszeiten um 8%';
$LNG['info'][14]['name']		 = 'Roboterfabrik';
$LNG['info'][14]['description']  = 'Roboterfabriken stellen einfache Arbeitskräfte zur Verfügung, die beim Bau der planetaren Infrastruktur eingesetzt werden können. Jede Stufe erhöht damit die Geschwindigkeit des Ausbaus von Gebäuden.';
$LNG['info'][15]['name']		 = 'Nanitenfabrik';
$LNG['info'][15]['description']  = 'Die Nanitenfabrik ist die Krönung der Robotertechnik. Naniten sind nanometergroße Roboter, die durch Vernetzung zu ausserordentlichen Leistungen im Stande sind. Einmal erforscht erhöhen sie die Produktivität in fast allen Bereichen. Die Nanitenfabrik halbiert pro Stufe die Bauzeit von Gebäuden, Schiffen und Verteidigungsanlagen.';
$LNG['info'][21]['name']		 = 'Raumschiffwerft';
$LNG['info'][21]['description']  = 'In der planetaren Werft werden alle Arten von Schiffen und Verteidigungsanlagen gebaut. Je grösser sie ist, desto schneller können aufwändigere und grössere Schiffe und Verteidigungsanlagen gebaut werden. Durch Anbau einer Nanitenfabrik werden winzige Roboter erstellt, die den Arbeitern helfen, schneller zu arbeiten.';
$LNG['info'][22]['name']		 = 'Metallspeicher';
$LNG['info'][22]['description']  = 'Riesige Lagerstätte für abgebautes Metallerz. Je grösser der Speicher, desto mehr Metall kann in ihm gelagert werden. Ist das Lager voll, wird kein Metall mehr abgebaut.';
$LNG['info'][23]['name']		 = 'Kristallspeicher';
$LNG['info'][23]['description']  = 'Das noch unbearbeitete Kristall wird in diesen riesigen Lagerhallen zwischengespeichert. Je grösser das Lager, desto mehr Kristall kann in ihm eingelagert werden. Sind die Kristalllager voll, wird kein weiteres Kristall abgebaut.';
$LNG['info'][24]['name']		 = 'Deuteriumspeicher';
$LNG['info'][24]['description']  = 'Riesige Tanks zur Lagerung des neu gewonnenen Deuteriums. Diese Lager findet man meistens in der Nähe von Raumhäfen. Je grösser sie sind, desto mehr Deuterium kann in ihnen gelagert werden. Sind sie gefuellt, wird kein Deuterium mehr abgebaut.';
$LNG['info'][25]['name']		 = 'Noriumspeicher';
$LNG['info'][25]['description']  = 'Das noch unbearbeitete Norium wird in diesen riesigen Lagerhallen zwischengespeichert. Je grösser das Lager, desto mehr Kristall kann in ihm eingelagert werden. Sind die Kristalllager voll, wird kein weiteres Kristall abgebaut.';
$LNG['info'][31]['name']		 = 'Forschungslabor';
$LNG['info'][31]['description']  = 'Um neue Technologien zu erforschen, ist der Betrieb einer Forschungsstation notwendig. Die Ausbaustufe einer Forschungsstation ist ausschlaggebend dafür, wie schnell eine neue Technologie erforscht werden kann. Je höher die Ausbaustufe des Labors, umso mehr neue Technologien können erforscht werden. Um die Forschungsarbeiten möglichst schnell zum Abschluss zu bringen, werden, wenn auf einem Planeten geforscht wird, automatisch alle verfügbaren Forscher in diese Forschungsstation geschickt und stehen somit auf anderen Planeten nicht mehr zur Verfügung. Sobald eine Technologie einmal erforscht ist, kehren die Forscher auf ihre Heimatplaneten zurück und bringen das Wissen um sie mit. So kann man die Technologie auf all seinen Planeten einsetzen.';
$LNG['info'][33]['name']		 = 'Terraformer';
$LNG['info'][33]['description']  = 'Mit zunehmendem Ausbau der Planeten, wurde die Frage des begrenzten Lebensraums auf Kolonien immer wichtiger. Traditionelle Methoden wie Hoch- und Tiefbau erwiesen sich zunehmend als unzureichend. Eine kleine Gruppe von Hochenergiephysikern und Nanotechnikern fand schliesslich die Lösung: Das Terraforming. Unter Aufwand riesiger Energiemengen kann der Terraformer ganze Landstriche oder gar Kontinente urbar machen. In diesem Gebäude werden fortwährend eigens dafür konstruierte Naniten produziert, die für eine konstante Qualität des Bodens sorgen. Einmal gebaut kann der Terraformer nicht wieder abgerissen werden.';
$LNG['info'][34]['name']		 = 'Allianzdepot';
$LNG['info'][34]['description']  = 'Das Allianzdepot bietet die Möglichkeit, befreundete Flotten, die bei der Verteidigung helfen und im Orbit stehen, mit Treibstoff zu versorgen. Für jeden Ausbaulevel des Allianzdepots können 10.000 Einheiten Deuterium pro Stunde an die zu versorgenden Flotten im Orbit geschickt werden.';


// ----------------------------------------------------------------------------------------------------------
// Mond Gebäude
$LNG['info'][41]['name']		 = 'Mondbasis';
$LNG['info'][41]['description']  = 'Ein Mond verfügt über keinerlei Atmosphäre, deshalb muss vor der Besiedlung eine Mondbasis errichtet werden. Diese sorgt für die nötige Atemluft, Gravitation und Wärme. Je höher die Ausbaustufe der Mondbasis ist, umso grösser ist die Fläche die mit einer Biosphäre versorgt wird. Pro Mondbasislevel können 3 Felder bebaut werden bis zum Maximum der Mondgrösse. Diese beträgt (Durchmesser des Mondes/1000)^2, wobei jede Stufe der Mondbasis selbst auch ein Feld belegt Einmal gebaut kann die Mondbasis nicht wieder abgerissen werden.';
$LNG['info'][42]['name']		 = 'Sensorphalanx';
$LNG['info'][42]['description']  = 'Hochauflösende Sensoren scannen das vollständige Frequenzspektrum aller auf die Phalanx auftreffenden Strahlungen. Hochleistungscomputer kombinieren winzige Energieschwankungen und gewinnen so Informationen über Schiffsbewegungen auf entfernten Planeten. Für den Scan muss Energie in Form von Deuterium (5.000) auf dem Mond bereitgestellt werden. Man scannt, indem man vom Mond aus ins Galaxiemenü wechselt und auf einen feindlichen Planeten in Sensorenreichweite (Phalanxstufe)^2 - 1 klickt.';
$LNG['info'][43]['name']		 = 'Sprungtor';
$LNG['info'][43]['description']  = 'Sprungtore sind riesige Transmitter, die in der Lage sind, selbst große Flotten ohne Zeitverlust durch das Universum zu versenden. Diese Transmitter verbrauchen kein Deuterium, jedoch muss zwischen 2 Sprüngen eine Stunde vergehen, da sich die Tore sonst überhitzen würden. Auch ist ein Mitschicken von Ressourcen nicht möglich. Der ganze Vorgang erfordert eine ungeheuer hoch entwickelte Technologie.';
$LNG['info'][44]['name']		 = 'Raketensilo';
$LNG['info'][44]['description']  = 'Raketensilos dienen zum Einlagern von Raketen. Pro ausgebauter Stufe kann man fünf Interplanetar- oder zehn Abfangraketen einlagern. Eine Interplanetarrakete benötigt soviel Platz wie zwei Abfrangraketen. Unterschiedliche Raketentypen können beliebig kombiniert werden.';

// ----------------------------------------------------------------------------------------------------------
// Forschung
$LNG['info'][106]['name']        = 'Spionagetechnik';
$LNG['info'][106]['description'] = 'Die Spionagetechnik befasst sich in erster Linie mit der Erforschung neuer und effizienterer Sensoren. Je höher diese Technik entwickelt ist, umso mehr Informationen stehen dem Nutzer über Vorgänge in seiner Umgebung zur Verfügung. Für Sonden ist die Differenz des eigenen und des gegnerischen Spionagelevels entscheidend. Je weiter die eigene Spionagetechnik erforscht ist, desto mehr Informationen enthält der Bericht und um so kleiner ist die Chance , dass man beim Spionieren entdeckt wird. Je mehr Sonden man schickt, desto mehr Details erfährt man von seinem Gegner, gleichzeitig steigt aber auch die Gefahr einer Entdeckung. Die Spionagetechnik verbessert ebenfalls die Ortung fremder Flotten. Dabei ist nur der eigene Spionagelevel entscheidend. Ab Level 2 wird zusätzlich zur reinen Angriffsmeldung auch die Gesamtanzahl der angreifenden Schiffe angezeigt. Ab Level 4 sieht man die Art der angreifenden Schiffe, sowie die Gesamtanzahl und ab Level 8 die genaue Anzahl der verschiedenen Schiffs-Typen. Für Raider ist diese Technik unverzichtbar, da sie Auskunft darüber gibt, ob das Opfer Flotte und/oder Verteidigung stationiert hat oder nicht. Deshalb sollte diese Technik schon sehr früh erforscht werden. Am besten sofort nach der Erforschung von kleinen Transportern.';
$LNG['info'][108]['name']        = 'Computertechnik';
$LNG['info'][108]['description'] = 'Die Computertechnik befasst sich mit der Erweiterung der vorhandenen Computerkapazitäten. Immer leistungsfähigere und effizientere Computersysteme werden entwickelt. Die Rechenleistung steigt immer weiter und die Geschwindigkeit, mit denen Rechenprozesse ablaufen, wird ebenfalls erhöht. Mit der Erhöhung der Computerkapazitäten lassen sich immer mehr Flotten gleichzeitig befehligen. Jede Stufe Computertechnik erhöht dabei die maximale Flottenanzahl um eins. Je mehr Flotten man gleichzeitig verschicken kann, desto mehr kann man raiden und desto mehr Rohstoffe kann man einnehmen. Natürlich nutzt diese Technik auch Händlern, denn sie können dann ebenfalls mehr Handelsflotten gleichzeitig losschicken. Aus diesem Grund sollte die Computertechnik kontinuierlich über das gesamte Spiel hinweg ausgebaut werden.';
$LNG['info'][109]['name']        = 'Waffentechnik';
$LNG['info'][109]['description'] = 'Die Waffentechnik beschäftigt sich vor allem mit der Weiterentwicklung bestehender Waffensysteme. Dabei wird insbesondere darauf Wert gelegt, die vorhandenen Systeme mit mehr Energie auszustatten und diese Energie punktgenau zu kanalisieren. Dadurch werden die Waffensysteme effizienter und Waffen richten mehr Schaden an. Jede Stufe der Waffentechnik erhöht die Waffenstärke der Einheiten um 10% des Grundwertes. Die Waffentechnik ist wichtig, um später die eigenen Einheiten konkurrenzfähig zu halten. Deshalb sollte sie kontinuierlich das ganze Spiel hindurch entwickelt werden.';
$LNG['info'][110]['name']        = 'Schildtechnik';
$LNG['info'][110]['description'] = 'Die Schildtechnik beschäftigt sich mit der Erforschung immer neuer Möglichkeiten, die Schilde mit mehr Energie zu versorgen und sie so effizienter und belastbarer zu machen. Dadurch steigt mit jeder erforschten Stufe die Effizienz der Schilde um 10% des Grundwertes.';
$LNG['info'][111]['name']        = 'Raumschiffpanzerrung';
$LNG['info'][111]['description'] = 'Spezielle Legierungen machen die Panzerung der Raumschiffe immer besser. Ist einmal eine sehr widerstandsfähige Legierung gefunden, wird durch spezielle Strahlungen die molekulare Struktur des Raumschiffes verändert und auf den Stand der besten erforschten Legierung gebracht. Die Wirksamkeit der Panzerung kann so pro Stufe um 10% des Grundwertes gesteigert werden.';
$LNG['info'][113]['name']        = 'Energietechnologie';
$LNG['info'][113]['description'] = 'Die Energietechnik beschäftigt sich mit der Weiterentwicklung der Energieleitsysteme und Energiespeicher, welche für viele neue Technologien benötigt wird.';
$LNG['info'][114]['name']        = 'Hyperraumtechnik';
$LNG['info'][114]['description'] = 'Durch die Einbindung der 4. und 5. Dimension ist es nun möglich einen neuartigen Antrieb zu erforschen, welcher sparsamer und leistungsfähiger ist.';
$LNG['info'][115]['name']        = 'Verbrennungstriebwerk';
$LNG['info'][115]['description'] = 'Verbrennungstriebwerke basieren auf dem uralten Prinzip des Rückstosses. Hocherhitzte Materie wird weggeschleudert und treibt das Schiff in die entgegengesetzte Richtung. Der Wirkungsgrad dieser Triebwerke ist eher gering, aber sie sind billig und zuverlässig und benötigen kaum Wartung. Ausserdem verbrauchen sie weniger Raum und sind deshalb gerade auf kleineren Schiffen immer wieder zu finden. Da Verbrennungstriebwerke die Grundlage jeder Raumfahrt sind, sollten sie so früh wie möglich erforscht werden. Die Weiterentwicklung dieser Triebwerke macht folgende Schiffe um 10% des Grundwertes pro Stufe schneller: Kleine und große Transporter, Leichte Jäger, Recycler und Spionagesonden.';
$LNG['info'][117]['name']        = 'Impulstriebwerk';
$LNG['info'][117]['description'] = 'Das Impulstriebwerk basiert auf dem Rükstossprinzip, wobei die Strahlmasse zum Grossteil als Abfallprodukt der zur Energiegewinnung verwendeten Kernfusion entsteht. Zusätzlich kann weitere Masse eingespritzt werden. Die Weiterentwicklung dieser Triebwerke macht folgende Schiffe um 20% des Grundwertes pro Stufe schneller: Bomber, Kreuzer, Schwere Jäger und Kolonieschiffe. Interplanetarraketen können pro Stufe weiter fliegen.';
$LNG['info'][118]['name']        = 'Hyperraumantrieb';
$LNG['info'][118]['description'] = 'Durch eine Raumzeitverkrümmung wird in unmittelbarer Umgebung eines Schiffes der Raum komprimiert, womit sich weite Strecken sehr schnell zurücklegen lassen. Je höher der Hyperraumantrieb entwickelt ist, desto höher wird die Kompression des Raumes, wodurch sich pro Stufe die Geschwindigkeit der Schiffe die damit ausgestattet sind (Schlachtkreuzer, Schlachtschiffe, Zerstörer und Todessterne) um 30% erhöht. Voraussetzungen: Hyperraumtechnik (Stufe 3) Forschungslabor (Stufe 7).';
$LNG['info'][120]['name']        = 'Lasertechnik';
$LNG['info'][120]['description'] = 'Laser (Lichtverstärkung durch induzierte Strahlungsemission) erzeugen einen intensiven, energiereichen Strahl von kohärentem Licht. Diese Geräte finden in allen möglichen Bereichen ihre Bewerbung, von optischen Computern bis hin zu schweren Laserwaffen, die mühelos durch Raumschiffpanzerungen schneiden. Die Lasertechnik bildet einen wichtigen Grundstein für die Erforschung weiterer Waffentechnologien. Voraussetzungen: Forschungslabor (Stufe 1) Energietechnik (Stufe 2).';
$LNG['info'][121]['name']        = 'Ionentechnik';
$LNG['info'][121]['description'] = 'Wahrhaft tödlicher Richtstrahl aus beschleunigten Ionen. Die beschleunigten Ionen richten beim Auftreffen auf ein Objekt einen riesigen Schaden an.';
$LNG['info'][122]['name']        = 'Plasmatechnik';
$LNG['info'][122]['description'] = 'Eine Weiterentwicklung der Ionentechnik, die nicht Ionen beschleunigt, sondern hochenergetisches Plasma. Das hochenergetische Plasma hat eine verheerende Wirkung beim Auftreffen auf ein Objekt.';
$LNG['info'][123]['name']        = 'Intergalaktisches Forschungsnetzwerk';
$LNG['info'][123]['description'] = 'Forscher verschiedener Planeten kommunizieren über dieses Netzwerk miteinander. Pro erforschtes Level, wird ein Forschungslabor vernetzt. Dabei werden immer die Labors der höchsten Stufe dazugeschaltet.Das vernetzte Labor muss ausreichend ausgebaut sein um die anstehende Forschung selbständig durchführen zu können. Die Ausbaustufen aller beteiligten Labors werden im intergalaktischen Forschungsnetzwerk zusammen gezählt.';
$LNG['info'][124]['name']        = 'Astrophysik';
$LNG['info'][124]['description'] = 'Weitere Erkenntnisse in der Astrophysik ermöglichen den Bau von Laboren, mit denen immer mehr Schiffe ausgestattet werden können. Dadurch werden weite Expeditionsreisen in noch unerforschte Gebiete möglich. Zudem erlauben die Fortschritte die weitere Kolonisation des Weltraumes. Pro zwei Stufen dieser Technologie kann so ein weiterer Planet nutzbar gemacht werden.';
$LNG['info'][131]['name']        = 'Produktionsmaximierung Metall';
$LNG['info'][131]['description'] = 'Erhöht die Produktion der Metallmine um 2%';
$LNG['info'][132]['name']        = 'Produktionsmaximierung Kristall';
$LNG['info'][132]['description'] = 'Erhöht die Produktion der Kristallmine um 2%';
$LNG['info'][133]['name']        = 'Produktionsmaximierung Deuterium';
$LNG['info'][133]['description'] = 'Erhöht die Produktion der Deuteriumsynthetisierer um 2%';
$LNG['info'][134]['name'] = 'Entfernung von Dunkler Materie';
$LNG['info'][134]['description'] = 'Dunkle Materie ist eine Ressource, zu teuer, und wer sie besitzt in großen Mengen wird ein Millionär werden. Die Extraktion Technik der Dunklen Materie wurde von führenden Wissenschaftlern des Reiches, durch ein Technokrat begleitet den letzten Punkt zu erreichen, die eine Methode zur Extraktion von dunkler Materie im Mond Porfin erhalten untersucht.';
$LNG['info'][199]['name']        = 'Gravitonforschung';
$LNG['info'][199]['description'] = 'Ein Graviton ist ein Partikel, das keine Masse und keine Ladung besitzt, welche die Gravitationskraft bestimmt. Durch Abschuss einer konzentrierten Ladung von Gravitonen kann ein künstliches Gravitationsfeld errichtet werden, welches ähnlich einem schwarzen Loch, Masse in sich hineinzieht, wodurch Schiffe oder auch Monde vernichtet werden können. Um eine ausreichende Menge Gravitonen herzustellen benötigt es riesige Mengen an Energie. Voraussetzungen: Forschungslabor (Stufe 12).';

// ----------------------------------------------------------------------------------------------------------
// Schiffe
$LNG['info'][202]['name']        = 'Kleiner Transporter';
$LNG['info'][202]['description'] = 'Transporter haben ungefähr die gleiche Größe wie Jäger, verzichten aber auf leistungsfähige Antriebe und Bordwaffen, um Platz für Frachtraum zu schaffen. Der kleine Transporter verfügt über eine Ladekapazität von 5.000 Ressourceneinheiten. Aufgrund ihrer geringen Feuerkraft werden Transporter oft von anderen Schiffen eskortiert.';
$LNG['info'][203]['name']        = 'Großer Transporter';
$LNG['info'][203]['description'] = 'Dieses Schiff hat kaum Waffen oder andere Technologien an Bord. Aus diesem Grunde sollten sie nie alleine losgeschickt werden. Der große Transporter dient durch sein hochentwickeltes Verbrennungstriebwerk als schneller Ressourcenlieferant zwischen den Planeten und natürlich begleitet er die Flotten auf ihren überfällen feindlicher Planeten, um möglichst viele Ressourcen zu erobern, der gro&szlig;e Transporter verfügt über eine Ladekapazität von 25.000 Ressourceneinheiten.';
$LNG['info'][204]['name']        = 'Leichter Jäger';
$LNG['info'][204]['description'] = 'Der leichte Jäger ist ein wendiges Schiff, das auf fast jedem Planeten vorgefunden wird. Die Kosten sind nicht besonders hoch, Schildstärke und Ladekapazität sind allerdings sehr gering.';
$LNG['info'][205]['name']        = 'Schwerer Jäger';
$LNG['info'][205]['description'] = 'Bei der Weiterentwicklung des leichten Jägers kamen die Forscher zu einem Punkt, bei welchem der konventionelle Antrieb nicht mehr ausreichend Leistungen erbrachte. Um das neue Schiff optimal fortbewegen zu können wurde zum ersten Mal der Impulsantrieb genutzt. Dieses erhöhte zwar die Kosten, eröffnete aber auch neue Möglichkeiten. Durch die Einsetzung dieses Antriebes blieb mehr Energie für Waffen und Schilde übrig, ausserdem wurden für diese neue Jägergattung auch qualitativ hochwertigere Materialien verwendet. Dies führte zu einer verbesserten strukturellen Integrität und einer höheren Feuerkraft, was ihn im Kampf zu einer immens grösseren Bedrohung macht als sein leichtes Pendant. Durch diese änderungen stellt der schwere Jäger eine neue ära der Schiffstechnologie dar, welche die Grundlage für die Kreuzertechnologie ist.';
$LNG['info'][206]['name']        = 'Kreuzer';
$LNG['info'][206]['description'] = 'Mit der Entwicklung der schweren Laser und der Ionenkanonen kamen die Jäger immer mehr in Bedrängnis. Trotz vieler Modifikationen konnte die Waffenstärke und die Panzerung nicht so weit gesteigert werden, um diesen Verteidigungsgeschützen wirksam begegnen zu können. Deshalb entschied man sich, eine neue Schiffsklasse zu konstruieren, die mehr Panzerung und mehr Feuerkraft in sich vereinte. Der Kreuzer war geboren. Kreuzer sind fast dreimal so stark gepanzert wie schwere Jäger und verfügen über mehr als die doppelte Schusskraft. Zudem sind sie sehr schnell. Gegen mittlere Verteidigung gibt es keine bessere Waffe. Kreuzer beherrschten fast ein Jahrhundert lang unumschränkt das All. Mit dem Aufkommen der Gaussgeschütze und Plasmawerfer endete ihre Vorherrschaft. Jedoch werden sie auch heute noch gerne gegen Jägerverbände eingesetzt.';
$LNG['info'][207]['name']        = 'Schlachtschiff';
$LNG['info'][207]['description'] = 'Schlachtschiffe bilden meist das Rückrat einer Flotte. Ihre schweren Geschütze, die hohe Geschwindigkeit und der gro&szlig;e Frachtraum, machen sie zu ernst zu nehmenden Gegnern.';
$LNG['info'][208]['name']        = 'Kolonieschiff';
$LNG['info'][208]['description'] = 'Dieses gut gepanzerte Schiff dient der Eroberung neuer Planeten, was für ein aufstrebendes Imperium unerlässlich ist. Das Schiff wird auf der neuen Kolonie als Rohstofflieferant genutzt, in dem es wieder auseinander gebaut wird und alles wiederverwertbare Material für die Erschliessung der neuen Welt genutzt wird. Pro Imperium können inklusive Hauptplanet maximal 9 Planeten kolonisiert werden.';
$LNG['info'][209]['name']        = 'Recycler';
$LNG['info'][209]['description'] = 'Die Weltraumgefechte nahmen immer grössere Ausmasse an. Tausende Schiffe wurden zerstört, aber die dadurch entstehenden Trümmerfelder schienen für immer verloren. Normale Transporter konnten sich nicht nahe genug an diese Felder heran bewegen, ohne durch kleinere Trümmer riesigen Schaden zu nehmen. Mit einer neuen Entwicklung im Bereich der Schildtechnologie konnte dieses Problem effizient beseitigt werden, es entstand eine neue Schiffsklasse, ähnlich dem großen Transporter, der Recycler . Mit dessen Hilfe konnten die scheinbar verlorenen Ressourcen doch noch verwertet werden. Die kleinen Trümmer stellten aufgrund der neuen Schilde auch keine Gefahr mehr dar. Durch spezielle mehr Dimensionale Ladefelder ist seine Ladekapazität auf 2.000.000 erweitert.';
$LNG['info'][210]['name']        = 'Spionagesonden';
$LNG['info'][210]['description'] = 'Spionagesonden sind kleine wendige Drohnen, welche über weite Entfernungen hinweg Daten über Flotten und Planeten liefern. Ihr Hochleistungstriebwerk ermöglicht ihnen weite Strecken in wenigen Sekunden zurück zu legen. Einmal in der Umlaufbahn eines Planeten angekommen verweilen sie dort kurz um Daten zu sammeln. Während dieser Zeit sind sie vom Feind relativ leicht entdeck- und angreifbar. Um Platz zu sparen wurde auf Panzerung, Schilde und Waffen verzichtet, was die Sonden, wenn sie einmal entdeckt wurden, zu leichten Zielen macht.';
$LNG['info'][211]['name']        = 'Bomber';
$LNG['info'][211]['description'] = 'Der Bomber wurde speziell entwickelt um die Verteidigung eines Planeten zu zerstören. Mit Hilfe einer lasergesteuerten Zielvorrichtung wirft er zielgenau Plasmabomben auf die Planetenoberfläche und richtet so einen verheerenden Schaden bei Verteidigungsanlagen an.';
$LNG['info'][212]['name']        = 'Solarsatellit';
$LNG['info'][212]['description'] = 'Solarsatelliten werden in eine geostationäre Umlaufbahn um einen Planeten geschossen. Sie bündeln Sonnenenergie und transferieren sie zu einer Bodenstation. Die Effizienz der Solarsatelliten hängt von der Stärke der Sonneneinstrahlung ab. Grundsätzlich ist die Energieausbeute auf sonnennahen Orbits grösser als auf Planeten mit sonnenfernen Orbit. Durch ihr gutes Preis/Leistungsverhältnis lösen Solarsatelliten die Energieprobleme vieler Welten. Aber Vorsicht: Solarsatelliten können im Kampf zerstört werden.';
$LNG['info'][213]['name']        = 'Zerstörer';
$LNG['info'][213]['description'] = 'Der Zerstörer ist der König unter den Kriegsschiffen. Seine Multiphalanx Ionen-, Plasma- und Gaussgeschütztürme können durch ihre verbesserten Anpeilungssensoren fast 99% der verteidigenden leichten Laser treffen. Da der Zerstörer sehr gross ist, ist seine Manövrierfähigkeit stark eingeschränkt, wodurch er im Kampf eher einer Kampfstation gleicht, als einem Kampfschiff. So hoch wie seine Kampfkraft ist auch sein Verbrauch an Deuterium.';
$LNG['info'][214]['name']        = 'Todesstern';
$LNG['info'][214]['description'] = 'Der Todesstern ist mit einer riesigen Gravitonkanone bewaffnet, die Schiffe so gross wie Zerstörer oder sogar Monde zerstören kann. Da dafür eine hohe Menge an Energie benötigt wird, besteht er fast nur aus Generatoren. Lediglich riesige Sternenreiche können überhaupt die Ressourcen und Arbeiter aufbringen, um dieses mondgroße Schiff zu Bauen.';
$LNG['info'][215]['name']        = 'Schlachtzreuzer';
$LNG['info'][215]['description'] = 'Dieses filigrane Schiff eignet sich hervorragend zum Zerstören feindlicher Flottenverbände. Mit seinen hochentwickelten Lasergeschützen ist es in der Lage, eine große Zahl angreifender Schiffe gleichzeitig zu bekämpfen. Durch seine schlanke Bauform und die starken Bewaffnung ist die Ladekapazität begrenzt. Dies wird jedoch durch den verbrauchsarmen Hyperraumantrieb wieder ausgeglichen.';
$LNG['info'][216]['name']        = 'Lune Noire';
$LNG['info'][216]['description'] = 'Dieses monströse Schiff ist eine Weiterentwicklung des Todessternes, die an Geschwindigkeit zugenommen hat, doch an Stärke verloren.  ';
$LNG['info'][217]['name']        = 'Evolutions Transporter';
$LNG['info'][217]['description'] = 'Dieser Transporter ist zwar langsamer aber dafür kann er jetzt mehr aufladen. Doch wenn man die richtige Forschung hat ist er fast so schnell wie der große Transporter.';
$LNG['info'][218]['name']        = 'Avatar';
$LNG['info'][218]['description'] = 'Dieses Schiff ist eine Verbesserung mehrerer Schiffe gleichzeitig und der Kaiser der Kampfsterne.';
$LNG['info'][219]['name']        = 'Gigarecycler';
$LNG['info'][219]['description'] = 'Dieses Schiff ist eine wahrhaft gigantische Recykelanlage im Weltraum mit Atemberaubender Geschwindigkeit und riesigem Lageraum! Geschaffen für große Imperien.';
$LNG['info'][220]['name']        = 'Intergalaktischer D. Materiesammler';
$LNG['info'][220]['description'] = 'Mit diesem Schiff ist es nach jahrelangem Forschen möglich, Dunkle Materie an seinem Mond zu sammeln.';

// ----------------------------------------------------------------------------------------------------------
// Verteidigung
$LNG['info'][401]['name']        = 'Raketenwerfer';
$LNG['info'][401]['description'] = 'Der Raketenwerfer ist eine einfache aber kostengünstige Verteidigungsmöglichkeit. Da er nur eine Weiterentwicklung gewöhnlicher ballistischer Feuerwaffen ist, benötigt er keine weitere Forschung. Seine geringen Herstellungskosten rechtfertigen seinen Einsatz gegen kleinere Flotten, er verliert aber mit der Zeit an Bedeutung. Später wird er nur noch als Schussfang hinter großen Geschützen eingesetzt. Verteidigungsanlagen deaktivieren sich, sobald sie zu stark beschädigt sind. Nach einer Schlacht betrtägt die Chance bis zu 70%, dass sich ausgefallene Verteidigungsanlagen wieder Instand setzen lassen.';
$LNG['info'][402]['name']        = 'Leichtes Lasergeschütz';
$LNG['info'][402]['description'] = 'Um die enormen Fortschritte im Bereich der Raumschifftechnologie kompensieren zu können, mussten die Forscher eine Verteidigungsanlage entwickeln, welche auch mit grösseren und besser ausgerüsteten Schiffen bzw. Flotten zurechtkommt. Dies war die Geburtsstunde des leichten Lasers. Durch den konzentrierten Beschuss eines Ziels mit Photonen konnte eine wesentlich grössere Schadenswirkung erzielt werden als mit gewöhnlichen ballistischen Waffen. Um der grösseren Feuerkraft der neuen Schiffstypen widerstehen zu können wurde er ausserdem mit verbesserten Schilden ausgestattet. Damit die Produktionskosten dennoch gering gehalten werden konnten wurde die Struktur nicht weiter verstärkt. Der leichte Laser besitzt das beste Preis-/Leistungsverhältnis überhaupt und ist dadurch auch für weiter fortgeschrittene Zivilisationen interessant. Verteidigungsanlagen deaktivieren sich, sobald sie zu stark beschädigt sind. Nach einer Schlacht beträgt die Chance bis zu 70%, dass sich die zerstörten Verteidigungsanlagen wieder Instand setzen lassen.';
$LNG['info'][403]['name']        = 'Schweres Lasergeschütz';
$LNG['info'][403]['description'] = 'Der schwere Laser stellt die konsequente Weiterentwicklung des Designs des leichten Lasers dar. Die Struktur wurde verstärkt und mit neuen Materialien verbessert. Die Hülle konnte so wesentlich widerstandsfähiger gemacht werden. Gleichzeitig wurden auch das Energiesystem und der Zielcomputer verbessert, so dass ein schwerer Laser wesentlich mehr Energie auf ein Ziel konzentrieren kann. Verteidigungsanlagen deaktivieren sich, sobald sie zu stark beschädigt sind. Nach einer Schlacht beträgt die Chance bis zu 70%, dass sich ausgefallene Verteidigungsanlagen wieder Instand setzen lassen.';
$LNG['info'][404]['name']        = 'Gaußkanone';
$LNG['info'][404]['description'] = 'Projektilwaffen galten lange Zeit neben der moderneren Kernfusions- und Energietechnik, der Entwicklung des Hyperraumantriebs und immer besserer Panzerungen als antiquiert, bis eben genau die Energietechnik, die sie einst verdrängt hatte, ihr wieder zu ihrem angestammten Platz verhalf. Das Prinzip war eigentlich schon aus dem 20. und 21. Jahrhundert der Erde bekannt - der Teilchenbeschleuniger. Eine Gaußkanone ist eigentlich nichts anderes als eine erheblich größere Version dieser Konstruktion. Tonnenschwere Geschosse werden unter gigantischem elektrischem Aufwand magnetisch beschleunigt und haben Mündungsgeschwindigkeiten, die die Schmutzteilchen in der Luft um das Geschoss verbrennen lassen und der Rückstoss bringt die Erde zum Beben. Dieser Durchschlagskraft können auch aktülle Panzerungen und Schilde nur schwer widerstehen, und es kommt nicht selten vor, dass das Ziel einfach durchschlagen wird. Verteidigungsanlagen deaktivieren sich, sobald sie zu stark beschädigt sind. Nach einer Schlacht beträgt die Chance bis zu 70%, dass sich ausgefallene Verteidigungsanlagen wieder Instand setzen lassen.';
$LNG['info'][405]['name']        = 'Ionengeschütz';
$LNG['info'][405]['description'] = 'Im 21. Jahrhundert der Erde gab es etwas, das allgemein als EMP bekannt war. EMP steht für Elektromagnetischer Puls, der die Eigenschaft hat, in alle Schaltkreise zusätzliche Spannungen zu induzieren und somit massenhafte Störungen zu verursachen, die alle empfindlichen Geräte zerstören können. Damals waren EMP - Waffen meistens noch auf Raketen- und Bombenbasis, auch in Verbindung mit Nuklearwaffen. Mittlerweile wurde der EMP ständig weiterentwickelt, da man in ihm ein großes Potential sah, Ziele nicht zu zerstören, aber kampf- und manövrierunfähig zu machen, so dass einer übernahme nichts mehr im Wege stand. Die bisher höchste Form einer EMP - Waffe stellt das Ionengeschütz dar. Es schleudert eine Welle von Ionen (elektrisch geladene Teilchen) auf das Ziel, welche die Schilde destabilisiert und alle Elektronik - sofern diese nicht massiv abgeschirmt ist - beschädigt, was nicht selten einer völligen Zerstörung gleichkommt. Die kinetische Durchschlagskraft kann vernachlässigt werden. Die Ionentechnik wird auch auf Kreuzern eingesetzt, jedoch auf keinem anderen Schiffstyp, da der Energieverbrauch der Ionengeschütze enorm ist und es in einem Gefecht häufig darauf ankommt, das Ziel zu zerstören und nicht nur zu paralysieren. Verteidigungsanlagen deaktivieren sich, sobald sie zu stark beschädigt sind. Nach einer Schlacht beträgt die Chance bis zu 70%, dass sich ausgefallene Verteidigungsanlagen wieder Instand setzen lassen.';
$LNG['info'][406]['name']        = 'Plasmawerfer';
$LNG['info'][406]['description'] = 'Die Lasertechnik war mittlerweile nahezu perfektioniert, die Ionentechnik hatte ein Endstadium erreicht und es galt mittlerweile als praktisch unmöglich, auch aus nur einem Waffensystem qualitativ gesehen noch mehr Effektivität herauszubekommen. Doch all dies sollte sich ändern, als man auf die Idee kam, beide Systeme miteinander zu kombinieren. Schon aus der Kernfusionstechnik bekannt, erhitzen Laser Teilchen ( meistens Deuterium ) auf extrem hohe Temperaturen, die schon einmal in die Millionen Grad gehen. Die Ionentechnik trägt ihren Teil in Form von elektrischer Aufladung, Stabilisierungsfeldern und Beschleunigern bei. Wird die abzufeuernde Ladung genügend erhitzt, unter Druck gesetzt und ionisiert, jagt man sie mittels Beschleunigern in die Weiten des Alls Richtung Ziel hinaus. Der grünlich glühende Plasmastrahl bietet einen imposanten Anblick, es fragt sich aber, ob die Crew des Zielschiffes lange an ihm Gefallen haben wird, wenn in wenigen Sekunden die Hülle zerfetzt und die Elektronik geschmort wird... Der Plasmawerfer gilt als eine der gefürchtetsten Waffen überhaupt, und diese Technik hat auch ihren Preis. Verteidigungsanlagen deaktivieren sich, sobald sie zu stark beschädigt sind. Nach einer Schlacht beträgt die Chance bis zu 70%, dass sich ausgefallene Verteidigungsanlagen wieder Instand setzen lassen.';
$LNG['info'][407]['name']        = 'Kleine Schildkuppel';
$LNG['info'][407]['description'] = 'Lange bevor die Schildgeneratoren klein genug waren, um auf Schiffen Einsatz zu finden, existierten bereits riesige Generatoren auf der Oberfläche von Planeten. Diese umhüllen den ganzen Planeten mit einem Kraftfeld, welches ungeheure Mengen an Energie absorbieren kann, bevor es zusammenbricht. Kleinere Angriffsflotten scheitern immer wieder an diesen Schildkuppeln. Mit zunehmender technologischer Entwicklung können diese Schilde noch verstärkt werden. Später kann man sogar eine große Schildkuppel bauen, die noch stärker ist. Pro Planet kann nur eine einzige kleine Schildkuppel gebaut werden.';
$LNG['info'][408]['name']        = 'Große Schildkuppel';
$LNG['info'][408]['description'] = 'Die Weiterentwicklung der kleinen Schildkuppel. Sie basiert auf den gleichen Technologien kann aber wesentlich mehr Energie einsetzen um feindliche Angriffe abzuhalten.';
$LNG['info'][409]['name']        = 'Gigantische Schildkuppel';
$LNG['info'][409]['description'] = 'Die Weiterentwicklung der Großen Schildkuppel. Sie basiert auf den gleichen Technologien kann aber wesentlich mehr Energie einsetzen um feindliche Angriffe abzuhalten.';
$LNG['info'][410]['name']        = 'Gravitonkannone';
$LNG['info'][410]['description'] = 'Sie basiert, wie der Name schon sagt, auf einer Gravitonkraft, bekannt aus dem Todesstern und aus besseren Schiffen.';
$LNG['info'][411]['name']        = 'Orbitale Verteidigungsplattform';
$LNG['info'][411]['description'] = 'Diese Plattform, mit gigantischem Ausma&szlig;, ist das Grö&szlig;te was das Universum je gesehen hat. Es ist eine unbewegliche defensive Plattform. Sie besitzt keinen direkten Antrieb und wird durch Gravitonforschung in einer stabilen Umlaufbahn des Planeten gehalten. Das Starten dieses Vorgangs erfordert hohe Massen an Energie. Die Forscher arbeiten an einer Möglichkeit, auf dieser Plattform Schiffe zu bauen, um sie als einen äusseren Verteidigungsring zu nutzen, der es dem Gegner erschwert zur Planetaren Verteidigung durchzubrechen. Durch das gigantische Ausmaß ist es nur möglich einer dieser Monster zu besitzen.';
// ----------------------------------------------------------------------------------------------------------
// Raketen
$LNG['info'][502]['name']        = 'Abfangraketen';
$LNG['info'][502]['description'] = 'Abfangraketen zerstören angreifende Intercontineltalraketen. Jede Bodenluftrakete zerstört eine Interplanetarrakete.';
$LNG['info'][503]['name']		 = 'Interplanetarraketen';
$LNG['info'][503]['description'] = 'Intercontinentalraketen zerstören die gegnerische Verteidigung, können allerdings durch Abfangraketen zerstört werden! Von Interplanetarraketen zerstörte Verteidigungsanlagen bauen sich nicht wieder auf.';


?>