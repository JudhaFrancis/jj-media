"use client";

import { motion } from "framer-motion";
import { ArrowUpRight } from "lucide-react";

const services = [
  { tag: 'Core', title: 'Billboard Advertising', desc: 'Static and digital placements. Formats from 40×20 to super-sized spectaculars.' },
  { tag: 'Design', title: 'Creative Production', desc: 'In-house digital design, wide-format printing, and professional installation teams.' },
  { tag: 'Cinematic', title: 'Brand Films', desc: 'High-end TVCs and brand storytelling films captured for high-impact viewing.' },
  { tag: 'Data', title: 'Media Planning', desc: 'Data-driven site selection utilizing traffic density and demographic insights.' },
  { tag: 'Urban', title: 'Transit Media', desc: 'Bus shelters, metro panels, and auto branding across Bengaluru\'s major hubs.' },
  { tag: 'Visual', title: 'Photography', desc: 'Professional editorial, commercial, and corporate portraiture for leading brands.' },
];

export default function Services() {
  return (
    <section id="services" className="py-24 md:py-32 px-6 md:px-24">
      <div className="mb-20 text-center md:text-left">
        <motion.span 
          initial={{ opacity: 0, x: -20 }}
          whileInView={{ opacity: 1, x: 0 }}
          viewport={{ once: true }}
          className="text-brand-gold uppercase tracking-[0.3em] text-xs font-bold px-4 py-1 border border-brand-gold/30 inline-block"
        >
          Expertise
        </motion.span>
        <motion.h2 
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ delay: 0.1 }}
          className="mt-6 text-5xl md:text-7xl font-heading font-black leading-tight"
        >
          Full-Spectrum<br />
          <span className="italic text-brand-gold selection:text-brand-text">Media Solutions</span>
        </motion.h2>
        <motion.p 
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ delay: 0.2 }}
          className="mt-6 text-brand-muted max-w-xl text-lg"
        >
          From architectural concept to precision installation, we turn strategic locations into cinematic brand statements.
        </motion.p>
      </div>

      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        {services.map((service, idx) => (
          <motion.div
            key={idx}
            initial={{ opacity: 0, y: 30 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ delay: idx * 0.1 }}
            className="bg-brand-card p-10 border border-white/5 hover:border-brand-gold group transition-all duration-500 relative overflow-hidden"
          >
            <div className="absolute top-0 left-0 w-full h-[1px] bg-brand-gold scale-x-0 group-hover:scale-x-100 transition-transform duration-700 origin-left"></div>
            <span className="text-[10px] uppercase tracking-widest text-brand-gold font-bold mb-4 block">
              {service.tag}
            </span>
            <h3 className="text-2xl font-heading font-bold mb-4 group-hover:text-brand-gold transition-colors">
              {service.title}
            </h3>
            <p className="text-brand-muted group-hover:text-brand-text transition-colors leading-relaxed">
              {service.desc}
            </p>
            <div className="mt-8 opacity-20 group-hover:opacity-100 transition-opacity">
              <ArrowUpRight className="w-6 h-6 transform group-hover:scale-110 transition-transform" />
            </div>
          </motion.div>
        ))}
      </div>
    </section>
  );
}
