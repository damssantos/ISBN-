const fs = require('fs');
const path = require('path');

const dir = path.join(__dirname, 'resources/views');
const files = fs.readdirSync(dir).filter(f => f.endsWith('.blade.php'));

for (const file of files) {
    const filePath = path.join(dir, file);
    let content = fs.readFileSync(filePath, 'utf8');

    // CSS variables replacements
    content = content.replace(/--primary:\s*#[a-f0-9]{6};/gi, '--primary:        #9BA8AB;');
    content = content.replace(/--primary-bright:\s*#[a-f0-9]{6};/gi, '--primary-bright: #CCD0CF;');
    content = content.replace(/--primary-dim:\s*#[a-f0-9]{6};/gi, '--primary-dim:    #4A5C6A;');
    content = content.replace(/--primary-glow:\s*rgba\([\d\s,.]+\);/gi, '--primary-glow:   rgba(155, 168, 171, 0.15);');
    content = content.replace(/--accent:\s*#[a-f0-9]{6};/gi, '--accent:         #CCD0CF;');
    content = content.replace(/--bg-body:\s*#[a-f0-9]{6};/gi, '--bg-body:        #06141B;');
    content = content.replace(/--bg-sidebar:\s*#[a-f0-9]{6};/gi, '--bg-sidebar:     #06141B;');
    content = content.replace(/--bg-card:\s*#[a-f0-9]{6};/gi, '--bg-card:        #11212D;');
    content = content.replace(/--bg-card-hover:\s*#[a-f0-9]{6};/gi, '--bg-card-hover:  #253745;');
    content = content.replace(/--bg-input:\s*#[a-f0-9]{6};/gi, '--bg-input:       #11212D;');
    content = content.replace(/--bg-elevated:\s*#[a-f0-9]{6};/gi, '--bg-elevated:    #253745;');
    content = content.replace(/--border-color:\s*#[a-f0-9]{6};/gi, '--border-color:   #253745;');
    content = content.replace(/--border-light:\s*#[a-f0-9]{6};/gi, '--border-light:   #11212D;');
    content = content.replace(/--text-primary:\s*#[a-f0-9]{6};/gi, '--text-primary:   #CCD0CF;');
    content = content.replace(/--text-secondary:\s*#[a-f0-9]{6};/gi, '--text-secondary: #9BA8AB;');
    content = content.replace(/--text-muted:\s*#[a-f0-9]{6};/gi, '--text-muted:     #4A5C6A;');
    content = content.replace(/--status-review-bg:\s*rgba\([\d\s,.]+\);/gi, '--status-review-bg:      rgba(204, 208, 207, 0.1);');
    content = content.replace(/--status-review-text:\s*#[a-f0-9]{6};/gi, '--status-review-text:    #CCD0CF;');
    content = content.replace(/--status-published-bg:\s*rgba\([\d\s,.]+\);/gi, '--status-published-bg:   rgba(155, 168, 171, 0.12);');
    content = content.replace(/--status-published-text:\s*#[a-f0-9]{6};/gi, '--status-published-text: #9BA8AB;');
    content = content.replace(/--status-draft-bg:\s*rgba\([\d\s,.]+\);/gi, '--status-draft-bg:       rgba(74, 92, 106, 0.08);');
    content = content.replace(/--status-draft-text:\s*#[a-f0-9]{6};/gi, '--status-draft-text:     #4A5C6A;');

    // Hardcoded color replacements
    content = content.replace(/rgba\(52,\s*211,\s*153/g, 'rgba(155,168,171');
    content = content.replace(/rgba\(5,\s*150,\s*105/g, 'rgba(74,92,106');
    content = content.replace(/#34d399/gi, '#9BA8AB');
    content = content.replace(/#6ee7b7/gi, '#CCD0CF');
    content = content.replace(/#059669/gi, '#4A5C6A');
    content = content.replace(/#0f1f1a/gi, '#06141B');
    content = content.replace(/#0a1814/gi, '#06141B');
    content = content.replace(/#1a2e28/gi, '#11212D');
    content = content.replace(/#213830/gi, '#253745');

    // Hardcoded gradients
    content = content.replace(/linear-gradient\(125deg,#0d3d30,#0f5040 45%,#136b54\)/g, 'linear-gradient(125deg,#06141B,#11212D 45%,#253745)');

    fs.writeFileSync(filePath, content, 'utf8');
    console.log(`Updated ${file}`);
}
