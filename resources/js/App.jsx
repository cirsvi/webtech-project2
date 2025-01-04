const topPaintings = [
    { "id":5,"artist_id":3,"style_id":1,"location_id":1,"title":"Woman with a Parasol - Madame Monet and Her Son","year":1875,"description":"Monet's light, spontaneous brushwork creates splashes of colour. Mrs Monet's veil is blown by the wind, as is her billowing white dress; the waving grass of the meadow is echoed by the green underside of her parasol. She is seen as if from below, with a strong upward perspective, against fluffy white clouds in an azure sky. A boy, Monet's seven-year-old son Jean, is placed further away, concealed behind a rise in the ground and visible only from the waist up, creating a sense of depth, the moment using animated brush strokes full of vibrant color.","image":"6776580cdebeb.jpg","display":1,"created_at":"2025-01-02T09:10:37.000000Z","updated_at":"2025-01-03T11:59:57.000000Z"},
    { "id":8,"artist_id":4,"style_id":3,"location_id":4,"title":"Judith and her Maidservant","year":1615,"description":"The painting depicts the moments after the biblical heroine Judith has assassinated the general Holofernes, and is fleeing his tent with her servant Abra.\r\n\r\nThe dark setting of the scene is brightened by the red and gold tones in the fabrics - colors which Gentileschi used frequently during her time in Florence. The use of deep colors and rich textures is characteristic of the Baroque period to which her work belongs.\r\n\r\nHer use of diagonal lines guides the viewer from the faces of the women to the head of Holofernes in the basket. She also uses intense contrast between dark and light to create three-dimensional volume.\r\n\r\nThe viewer is reminded of the violence which preceded this moment by the screaming head depicted on the pommel of the sword, thought to be a mythological figure such as Medusa. The presence of fresh blood dripping from the basket the maidservant is carrying, which shows Holofernes's head in full view, also invokes the violence of the scene the two figures are leaving. The intense depiction of gore is also characteristic of Baroque painting, which, unlike previous artistic movements, did not shy away from bloody depictions of biblical scenes.","image":"6778e98bad415.jpg","display":1,"created_at":"2025-01-04T07:55:55.000000Z","updated_at":"2025-01-04T07:55:55.000000Z" },
    { "id":7,"artist_id":4,"style_id":3,"location_id":4,"title":"Judith Slaying Holofernes","year":1620,"description":"Gentileschi centers her work on the labor of the killing, which forces the gaze to start amid the tangle of blood, limbs, and metal. Her ability to display brutal realism is shown particularly in the details, such as the arc of carotid blood that spatters across the frame. This scene displays the use of chiaroscuro, or the drastic contrast between light and dark, both literally and figuratively.\r\n\r\nHolofernes struggles in vain to press against Abra as the two women force him down with distinctly strong arms.[4] Their sleeves are rolled up, as though they are performing an unavoidable domestic chore, and their faces express a staunch resolve. Judith drives the sword, which is noticeably vertical and shaped in a way that alludes to a cross, into flesh with an exertive force. Abra is depicted as almost a mirror to Judith, with a youthful appearance that departs from earlier portrayals of her character. She holds firm to the left arm of their victim as he pushes against her breast in desperation. Holofernes, whose blood puddles and spurts a deep red to contrast the white sheets of his deathbed, is overpowered and without hope.","image":"6778e87766043.jpg","display":1,"created_at":"2025-01-04T07:51:19.000000Z","updated_at":"2025-01-04T07:51:19.000000Z" }
];

const selectedPainting = {
    "id":7,
    "artist_id":4,
    "style_id":3,
    "location_id":4,
    "title":"Judith Slaying Holofernes",
    "year":1620,
    "description":"Gentileschi centers her work on the labor of the killing, which forces the gaze to start amid the tangle of blood, limbs, and metal. Her ability to display brutal realism is shown particularly in the details, such as the arc of carotid blood that spatters across the frame. This scene displays the use of chiaroscuro, or the drastic contrast between light and dark, both literally and figuratively.\r\n\r\nHolofernes struggles in vain to press against Abra as the two women force him down with distinctly strong arms.[4] Their sleeves are rolled up, as though they are performing an unavoidable domestic chore, and their faces express a staunch resolve. Judith drives the sword, which is noticeably vertical and shaped in a way that alludes to a cross, into flesh with an exertive force. Abra is depicted as almost a mirror to Judith, with a youthful appearance that departs from earlier portrayals of her character. She holds firm to the left arm of their victim as he pushes against her breast in desperation. Holofernes, whose blood puddles and spurts a deep red to contrast the white sheets of his deathbed, is overpowered and without hope.","image":"6778e87766043.jpg","display":1,"created_at":"2025-01-04T07:51:19.000000Z","updated_at":"2025-01-04T07:51:19.000000Z"
};

const relatedPaintingss = [
    { "id":5,"artist_id":3,"style_id":1,"location_id":1,"title":"Woman with a Parasol - Madame Monet and Her Son","year":1875,"description":"Monet's light, spontaneous brushwork creates splashes of colour. Mrs Monet's veil is blown by the wind, as is her billowing white dress; the waving grass of the meadow is echoed by the green underside of her parasol. She is seen as if from below, with a strong upward perspective, against fluffy white clouds in an azure sky. A boy, Monet's seven-year-old son Jean, is placed further away, concealed behind a rise in the ground and visible only from the waist up, creating a sense of depth, the moment using animated brush strokes full of vibrant color.","image":"6776580cdebeb.jpg","display":1,"created_at":"2025-01-02T09:10:37.000000Z","updated_at":"2025-01-03T11:59:57.000000Z" },
    { "id":8,"artist_id":4,"style_id":3,"location_id":4,"title":"Judith and her Maidservant","year":1615,"description":"The painting depicts the moments after the biblical heroine Judith has assassinated the general Holofernes, and is fleeing his tent with her servant Abra.\r\n\r\nThe dark setting of the scene is brightened by the red and gold tones in the fabrics - colors which Gentileschi used frequently during her time in Florence. The use of deep colors and rich textures is characteristic of the Baroque period to which her work belongs.\r\n\r\nHer use of diagonal lines guides the viewer from the faces of the women to the head of Holofernes in the basket. She also uses intense contrast between dark and light to create three-dimensional volume.\r\n\r\nThe viewer is reminded of the violence which preceded this moment by the screaming head depicted on the pommel of the sword, thought to be a mythological figure such as Medusa. The presence of fresh blood dripping from the basket the maidservant is carrying, which shows Holofernes's head in full view, also invokes the violence of the scene the two figures are leaving. The intense depiction of gore is also characteristic of Baroque painting, which, unlike previous artistic movements, did not shy away from bloody depictions of biblical scenes.","image":"6778e98bad415.jpg","display":1,"created_at":"2025-01-04T07:55:55.000000Z","updated_at":"2025-01-04T07:55:55.000000Z" },
    {"id":6,"artist_id":2,"style_id":2,"location_id":3,"title":"The Starry Night","year":1889,"description":"The Starry Night is an oil-on-canvas painting by the Dutch Post-Impressionist painter Vincent van Gogh, painted in June 1889. It depicts the view from the east-facing window of his asylum room at Saint-R\u00e9my-de-Provence, just before sunrise, with the addition of an imaginary village. It has been in the permanent collection of the Museum of Modern Art in New York City since 1941, acquired through the Lillie P. Bliss Bequest. Widely regarded as Van Gogh's magnum opus, The Starry Night is one of the most recognizable paintings in Western art.","image":"6776d0f12c97e.jpg","display":1,"created_at":"2025-01-02T17:46:25.000000Z","updated_at":"2025-01-02T17:46:25.000000Z"}
];
      
export default function App(){
    return (
        <>
            <Header />
            <main className="mb-8 px-2 md:container md:mx-auto">
                <h1>Hello, World!</h1>
            </main>
            <Footer />
        </>
    )
}

// Header and Footer components -
// structural components without processing or data.

function Header(){
    return(
        <header className="bg-green-500 mb-8 py-2 sticky top-0">    
        <div className="px-2 py-2 font-serif text-green-50 text-xl leading-6
                        md:container md:mx-auto">
                        Painting Catalog
        </div>
        </header>
    )
}

function Footer(){
    return(
        <footer className="bg-neutral-300 mt-8">
            <div className="py-8 md:container md:mx-auto px-2">
                V. Cirša, Vea, 2005
            </div>
        </footer>
    )
}
