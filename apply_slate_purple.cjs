const fs = require('fs');
const path = require('path');

const dir = path.join(__dirname, 'resources/views');
const files = fs.readdirSync(dir).filter(f => f.endsWith('.blade.php'));

for (const file of files) {
    const filePath = path.join(dir, file);
    let content = fs.readFileSync(filePath, 'utf8');

    // Hardcoded gradients (do this first)
    content = content.replace(/linear-gradient\(125deg,#06141B,#11212D 45%,#253745\)/ig, 'linear-gradient(125deg,#15131E,#1E1B2E 45%,#2D2845)');
    content = content.replace(/linear-gradient\(125deg,#0d3d30,#0f5040 45%,#136b54\)/ig, 'linear-gradient(125deg,#15131E,#1E1B2E 45%,#2D2845)');

    // CSS variables replacements
    content = content.replace(/--primary:\s*#[a-f0-9]{6};/gi, '--primary:        #8B5CF6;');
    content = content.replace(/--primary-bright:\s*#[a-f0-9]{6};/gi, '--primary-bright: #A78BFA;');
    content = content.replace(/--primary-dim:\s*#[a-f0-9]{6};/gi, '--primary-dim:    #6D28D9;');
    content = content.replace(/--primary-glow:\s*rgba\([\d\s,.]+\);/gi, '--primary-glow:   rgba(139, 92, 246, 0.15);');
    content = content.replace(/--accent:\s*#[a-f0-9]{6};/gi, '--accent:         #8B5CF6;');
    
    // Backgrounds & Borders
    content = content.replace(/--bg-body:\s*#[a-f0-9]{6};/gi, '--bg-body:        #15131E;');
    content = content.replace(/--bg-sidebar:\s*#[a-f0-9]{6};/gi, '--bg-sidebar:     #1E1B2E;');
    content = content.replace(/--bg-card:\s*#[a-f0-9]{6};/gi, '--bg-card:        #231F36;');
    content = content.replace(/--bg-card-hover:\s*#[a-f0-9]{6};/gi, '--bg-card-hover:  #2D2845;');
    content = content.replace(/--bg-input:\s*#[a-f0-9]{6};/gi, '--bg-input:       #1B1829;');
    content = content.replace(/--bg-elevated:\s*#[a-f0-9]{6};/gi, '--bg-elevated:    #2D2845;');
    content = content.replace(/--border-color:\s*#[a-f0-9]{6};/gi, '--border-color:   #342E4A;');
    content = content.replace(/--border-light:\s*#[a-f0-9]{6};/gi, '--border-light:   #231F36;');
    
    // Text colors
    content = content.replace(/--text-primary:\s*#[a-f0-9]{6};/gi, '--text-primary:   #E2D8F0;');
    content = content.replace(/--text-secondary:\s*#[a-f0-9]{6};/gi, '--text-secondary: #A59EBA;');
    content = content.replace(/--text-muted:\s*#[a-f0-9]{6};/gi, '--text-muted:     #6F6987;');
    
    // Status colors
    content = content.replace(/--status-review-bg:\s*rgba\([\d\s,.]+\);/gi, '--status-review-bg:      rgba(139, 92, 246, 0.1);');
    content = content.replace(/--status-review-text:\s*#[a-f0-9]{6};/gi, '--status-review-text:    #A78BFA;');
    content = content.replace(/--status-published-bg:\s*rgba\([\d\s,.]+\);/gi, '--status-published-bg:   rgba(16, 185, 129, 0.12);');
    content = content.replace(/--status-published-text:\s*#[a-f0-9]{6};/gi, '--status-published-text: #34D399;');
    content = content.replace(/--status-draft-bg:\s*rgba\([\d\s,.]+\);/gi, '--status-draft-bg:       rgba(107, 114, 128, 0.08);');
    content = content.replace(/--status-draft-text:\s*#[a-f0-9]{6};/gi, '--status-draft-text:     #9CA3AF;');

    // Hardcoded color replacements (rgba first)
    content = content.replace(/rgba\(155,\s*168,\s*171/g, 'rgba(139,92,246');
    content = content.replace(/rgba\(74,\s*92,\s*106/g, 'rgba(109,40,217');
    content = content.replace(/rgba\(52,\s*211,\s*153/g, 'rgba(139,92,246');
    content = content.replace(/rgba\(5,\s*150,\s*105/g, 'rgba(109,40,217');

    content = content.replace(/#9BA8AB/gi, '#8B5CF6'); // primary
    content = content.replace(/#CCD0CF/gi, '#A78BFA'); // primary-bright
    content = content.replace(/#4A5C6A/gi, '#6D28D9'); // primary-dim
    content = content.replace(/#34d399/gi, '#8B5CF6'); 
    content = content.replace(/#6ee7b7/gi, '#A78BFA');
    content = content.replace(/#059669/gi, '#6D28D9');
    
    content = content.replace(/#06141B/gi, '#15131E'); // body/sidebar
    content = content.replace(/#11212D/gi, '#231F36'); // card/input
    content = content.replace(/#253745/gi, '#2D2845'); // card-hover/elevated/border
    content = content.replace(/#0f1f1a/gi, '#15131E');
    content = content.replace(/#0a1814/gi, '#15131E');
    content = content.replace(/#1a2e28/gi, '#231F36');
    content = content.replace(/#213830/gi, '#2D2845');

    fs.writeFileSync(filePath, content, 'utf8');
    console.log(`Updated ${file}`);
}
